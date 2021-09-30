<?php

namespace App\Controllers\Admin\Api;

use App\Entities\SysProduct;
use App\Entities\SysProductInvoiceProduct;
use App\Models\SysProductInvoice;
use App\Models\SysProductInvoiceProducts;
use App\Models\SysProducts;
use CodeIgniter\RESTful\ResourceController;
use DateTime;
use Exception;

class Invoices extends ResourceController
{

	protected $format = 'json';

	public function index()
	{
		$day = $this->request->getGet('day');
		if (!empty($day)) $current = date('W-Y', strtotime($day));
		else $current = $this->request->getGet('week');

		if (empty($current)) $current = date('W-Y');

		list($week, $year) = explode('-', $current);
		$startDate = (new DateTime())->setISODate($year, $week, 0);
		$start = $startDate->format('Y-m-d');
		$end = date('Y-m-d', strtotime($start . '+6 days'));
		$prev = $startDate->format(('W-Y'));
		$startDate->modify('+2 week');
		$next = $startDate->format('W-Y');

		$invoices = (new SysProductInvoice())
			->select('sys_product_invoice.*, sys_customers.name as sys_customer_id')
			->join('sys_customers', 'sys_customers.id = sys_product_invoice.sys_customer_id')
			->where('sys_product_invoice.date >=', $start)
			->where('sys_product_invoice.date <=', $end)
			->asArray()
			->findAll();

		$result = [
			'date'     => [
				'current' => $current,
				'prev'    => $prev,
				'next'    => $next,
				'start'   => $start,
				'end'     => $end,
			],
			'invoices' => $invoices,
		];

		return $this->respond($result);
	}

	public function status($invoiceId, $statusId)
	{
		try
		{
			$result = (new SysProductInvoice())->update($invoiceId, ['sys_product_invoice_status_id' => $statusId]);

			if ($statusId == 5 && $result)
			{
				/** @var SysProductInvoiceProduct[] $invoiceProducts */
				$invoiceProducts = (new SysProductInvoiceProducts())->where('sys_product_invoice_id', $invoiceId)->findAll();
				$SysProducts = new SysProducts();
				foreach ($invoiceProducts as $invoiceProduct)
				{
					/** @var SysProduct $product */
					$product = $SysProducts->find($invoiceProduct->sys_product_id);
					$SysProducts->update($product->id, [
						'amount' => $product->amount + $invoiceProduct->amount,
					]);
				}
			}

			return $this->respond($result);

		} catch (Exception $ex)
		{
			return $this->failServerError($ex->getMessage());
		}
	}

}