<?php

namespace App\Controllers\Admin\Api;

use App\Models\SysCustomers;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class Customer extends ResourceController
{

	protected $format = 'json';

	public function index()
	{
		$filter = $this->request->getGet('filter');

		$customers = new SysCustomers();
		if (!empty($filter)) $customers->like('name', $filter);

		return $this->respond(
			$customers->orderBy('name')->asArray()->findAll()
		);
	}

	public function enable($id)
	{
		try
		{
			(new SysCustomers())->update($id, ['disabled' => 0]);

			return $this->respondUpdated();
		} catch (Exception $ex)
		{
			return $this->failServerError($ex->getMessage());
		}
	}

	public function disable($id)
	{
		try
		{
			(new SysCustomers())->update($id, ['disabled' => 1]);

			return $this->respondUpdated();
		} catch (Exception $ex)
		{
			return $this->failServerError($ex->getMessage());
		}
	}

}