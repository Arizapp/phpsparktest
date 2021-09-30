<?php

namespace App\Controllers\Admin\Api;

use App\Models\SysProductInvoiceProducts;
use App\Models\SysProducts;
use CodeIgniter\RESTful\ResourceController;
use Config\Paths;
use Exception;

class Products extends ResourceController
{

	protected $modelName = SysProducts::class;
	protected $format    = 'json';

	public function index()
	{
		if ($category = $this->request->getGet('category')) $this->model->where('sys_product_category_id', $category);

		return $this->respond(
			$this->model
				->orderBy('name')
				->findAll()
		);
	}

	public function create()
	{
		try
		{
			if ($product = $this->request->getPost())
			{
				unset($product['picture']);
				if ($picture = $this->request->getFile('picture'))
				{
					$imageUploadDirectory = (new Paths())->imageUploadDirectory;
					if ($picture->isValid() && !$picture->hasMoved())
					{
						$product['picture'] = $picture->getRandomName();
						$picture->move($imageUploadDirectory, $product['picture']);
					}
				}
				$this->model->insert($product);
			}

			return $this->respond(true);
		} catch (Exception $e)
		{
//			if ($e->getCode() == 1062) return $this->respond(null, 500, utf8_decode("Já existe uma categoria chamada: {$name}"));

			return $this->respond(null, 500, utf8_decode($e->getMessage()) . " ({$e->getCode()})");
		}
	}

	public function update($id = null)
	{
		try
		{
			$product = $this->request->getPost();
			if ($id && $product)
			{
				unset($product['picture']);
				if ($picture = $this->request->getFile('picture'))
				{
					$imageUploadDirectory = (new Paths())->imageUploadDirectory;
					if ($picture->isValid() && !$picture->hasMoved())
					{
						$product['picture'] = $picture->getRandomName();
						$picture->move($imageUploadDirectory, $product['picture']);
						$SysProduct = $this->model->find($id);
						if (isset($SysProduct->id)) $oldFile = realpath($imageUploadDirectory . DIRECTORY_SEPARATOR . $SysProduct->picture);
					}
				}
				$this->model->update($id, $product);
				if (isset($oldFile) && is_file($oldFile)) unlink($oldFile);
			}

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
				$count = (new SysProductInvoiceProducts())->where('sys_product_id', $id)->countAllResults();
				if ($count) throw new Exception("Existem {$count} pedidos associados a este produto.");
				$this->model->delete($id);
			}

			return $this->respond(true);
		} catch (Exception $e)
		{
			return $this->respond(null, 500, utf8_decode($e->getMessage()));
		}
	}

}