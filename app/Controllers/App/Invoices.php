<?php namespace App\Controllers\App;

use App\Models\SysPages;
use Exception;

class Invoices extends AppController
{
	public function index()
	{
		$data = [];
		try
		{
			$page = (new SysPages())->find(uri_string());
			$data[] = 'page';
		} catch (Exception $error)
		{
			$data[] = 'error';
		}

		return view('App/Invoices/index', compact($data));
	}

}
