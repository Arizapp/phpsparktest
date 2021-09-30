<?php

namespace App\Controllers\Admin;

use App\Models\SysProductInvoice;
use App\Models\SysProductInvoiceStatus;
use App\Models\SysProducts;
use DateTime;

class Invoices extends AdminController
{

	public function index()
	{
        $view = 'Admin/Invoices/index';
        $data[] = 'view';

        return view($view, compact($data));
	}

	public function print($week = null)
	{
		$data = [];

		if (empty($week)) $week = date('W-Y');

		list($week, $year) = explode('-', $week);
		$startDate = (new DateTime())->setISODate($year, $week, 0);
		$start = $startDate->format('Y-m-d');
		$end = date('Y-m-d', strtotime($start . '+6 days'));

		$invoices = (new SysProductInvoice())
			->select('sys_product_invoice.*, sys_customers.name as sys_customer_id')
			->join('sys_customers', 'sys_customers.id = sys_product_invoice.sys_customer_id')
			->where('sys_product_invoice.date >=', $start)
			->where('sys_product_invoice.date <=', $end)
			->asArray()
			->findAll();
		$data[] = 'invoices';

		$products = [];
		foreach ($invoices as $invoice)
		{
			$products[ $invoice['id'] ] = (new SysProducts)
				->select('sys_products.*, 
					sys_product_invoice_products.amount as amount,
					sys_product_invoice_products.unitary_value as value,
					sys_product_categories.name as sys_product_category_id
					')
				->join('sys_product_invoice_products', 'sys_product_invoice_products.sys_product_id = sys_products.id')
				->join('sys_product_invoice', 'sys_product_invoice_products.sys_product_invoice_id = sys_product_invoice.id')
				->join('sys_product_categories', 'sys_product_categories.id = sys_products.sys_product_category_id')
				->where('sys_product_invoice.id', $invoice['id'])
				->orderBy('sys_product_categories.name')
				->orderBy('sys_products.name')
				->asArray()
				->findAll();
		}
		$data[] = 'products';

		$status = [];
		foreach((new SysProductInvoiceStatus())->asArray()->findAll() as $item) {
		    $status[$item['id']] = $item['name'];
        }
        $data[] = 'status';

        $view = 'Admin/Invoices/print';
        $data[] = 'view';

        return view($view, compact($data));
	}

}