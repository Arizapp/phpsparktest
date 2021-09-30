<?php

namespace App\Controllers\Api;

use App\Models\SysProductCategories;
use CodeIgniter\RESTful\ResourceController;

class ProductCategories extends ResourceController
{

	protected $modelName = SysProductCategories::class;
	protected $format    = 'json';

	public function index()
	{
		return $this->respond(
			$this->model
				->select('sys_product_categories.*')
				->join('sys_products', 'sys_products.sys_product_category_id = sys_product_categories.id')
				->where('sys_products.amount >', 0)
				->orderBy('sys_product_categories.name')
				->groupBy('sys_product_categories.id')
				->findAll()
		);
	}

	public function invoice()
	{
		$output = [];
		foreach ($this->model->findAll() as $row)
		{
			$output[ $row->id ] = $row->name;
		}

		return $this->respond($output);
	}

}