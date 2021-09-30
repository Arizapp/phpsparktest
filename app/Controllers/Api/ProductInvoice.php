<?php

namespace App\Controllers\Api;

use App\Libraries\Customer\Auth;
use App\Models\SysProductInvoice;
use CodeIgniter\RESTful\ResourceController;

class ProductInvoice extends ResourceController
{

	protected $modelName = SysProductInvoice::class;
	protected $format    = 'json';

	const LIMIT = 10;

	public function index($page = 1)
	{
		$auth = (new Auth());

		if (!$auth->isLogged()) $this->failUnauthorized();

		$invoices = $this->model
			->where('sys_customer_id', $auth->user()->id)
			->orderBy('date', 'desc')
			->asArray()
			->findAll(self::LIMIT, ($page - 1) * self::LIMIT);

		foreach ($invoices as $invoice) $ids[] = $invoice['id'];
		if (!empty($ids))
		{
			$ids = implode(',', $ids);
			$query = db_connect()->query("SELECT id, sys_product_invoice_id, SUM(amount) as amount FROM sys_product_invoice_products WHERE sys_product_invoice_id IN ({$ids}) GROUP BY sys_product_invoice_id");
			$result = [];
			foreach ($query->getResultArray() as $row) $result[$row['sys_product_invoice_id']] = $row;
			foreach ($invoices as &$invoice) $invoice['amount'] = $result[ $invoice['id'] ]['amount'];
		}

		return $this->respond($invoices);
	}

	public function pages()
	{
		$auth = (new Auth());

		if (!$auth->isLogged()) $this->failUnauthorized();

		$total = $this->model->where('sys_customer_id', $auth->user()->id)->countAllResults();
		$pages = ceil($total / self::LIMIT);

		return $this->respond([
			'total' => $total,
			'pages' => $pages,
		]);
	}
}