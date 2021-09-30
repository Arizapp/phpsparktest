<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Cart extends ResourceController
{

	protected $format = 'json';

	public function index()
	{
		return $this->respond((new \App\Libraries\Builder\Cart())->get());
	}

	public function add($id)
	{
		(new \App\Libraries\Builder\Cart())->add($id);
	}

	public function del($id)
	{
		(new \App\Libraries\Builder\Cart())->del($id);
	}

	public function clear()
	{
		(new \App\Libraries\Builder\Cart())->clear();
	}

}