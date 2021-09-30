<?php

namespace App\Controllers\Admin\Api;

use App\Models\SysProductCategories;
use App\Models\SysProducts;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ProductCategories extends ResourceController
{

	protected $modelName = SysProductCategories::class;
	protected $format    = 'json';

	public function index()
	{
		return $this->respond($this->model->orderBy('name')->findAll());
	}

	public function create()
	{
		try
		{
			if ($name = $this->request->getPost('name')) $this->model->insert(['name' => $name]);

			return $this->respond(true);
		} catch (Exception $e)
		{
			if ($e->getCode() == 1062) return $this->respond(null, 500, utf8_decode("Já existe uma categoria chamada: {$name}"));

			return $this->respond(null, 500, utf8_decode($e->getMessage()));
		}
	}

	public function update($id = null)
	{
		try
		{
			$input = $this->request->getRawInput();
			if ($id && isset($input['category'])) $this->model->update($id, $input['category']);

			return $this->respond(true);
		} catch (Exception $e)
		{
			return $this->respond(null, 500, utf8_decode($e->getMessage()));
		}
	}

	public function delete($id = null)
	{
		try
		{
			if ($id)
			{
				$count = (new SysProducts())->where('sys_product_category_id', $id)->countAllResults();
				if ($count) throw new Exception("Existem {$count} produtos associados a esta categoria.");
				$this->model->delete($id);
			}

			return $this->respond(true);
		} catch (Exception $e)
		{
			return $this->respond(null, 500, utf8_decode($e->getMessage()));
		}
	}

}