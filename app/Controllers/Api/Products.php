<?php

namespace App\Controllers\Api;

use App\Libraries\Customer\Auth;
use App\Models\SysProducts;
use CodeIgniter\RESTful\ResourceController;

class Products extends ResourceController
{

	protected $modelName = SysProducts::class;
	protected $format    = 'json';

	public function index()
	{
		return $this->respond(
			$this->model
				->where('amount >', 0)
				->orderBy('sys_product_category_id')
				->orderBy('name')
				->findAll()
		);
	}

	public function invoice($id)
	{
		$auth = (new Auth());
		$authAdmin = (new \App\Libraries\Admin\Auth());

		if ($auth->isLogged() || $authAdmin->isLogged())
		{
			if ($auth->isLogged() && !$authAdmin->isLogged())
			{
				$this->model->where('sys_product_invoice.sys_customer_id', $auth->user()->id);
			}

			$produtos = $this->model->select('sys_products.*, 
					sys_product_invoice_products.amount as amount,
					sys_product_invoice_products.unitary_value as value
					')
				->join('sys_product_invoice_products', 'sys_product_invoice_products.sys_product_id = sys_products.id')
				->join('sys_product_invoice', 'sys_product_invoice_products.sys_product_invoice_id = sys_product_invoice.id')
				->join('sys_product_categories', 'sys_product_categories.id = sys_products.sys_product_category_id')
				->where('sys_product_invoice.id', $id)
				->orderBy('sys_product_categories.name')
				->orderBy('sys_products.name')
				->asArray()
				->findAll();

			foreach ($produtos as &$produto)
			{
				$produto['showPic'] = false;
			}

			return $this->respond($produtos);
		}

		return $this->failUnauthorized();
	}
}