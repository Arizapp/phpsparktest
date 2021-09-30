<?php

namespace App\Controllers\Api;

use App\Models\SysProductCategories;
use App\Models\SysProductInvoiceStatus;
use CodeIgniter\RESTful\ResourceController;

class InvoiceStatus extends ResourceController
{

	protected $modelName = SysProductInvoiceStatus::class;
	protected $format    = 'json';

	public function index()
	{
		$output = [];
		foreach ($this->model->findAll() as $row)
		{
			$output[ $row->id ] = $row->name;
		}

		return $this->respond($output);
	}

}