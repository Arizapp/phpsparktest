<?php namespace App\Controllers\App;

use App\Models\SysPages;
use Exception;

class Cart extends AppController
{
	public function index()
	{
		$data = [];
		try
		{
			$page = (new SysPages())->find(uri_string());
			$data[] = 'page';
			$cart = (new \App\Libraries\Builder\Cart())->checkout();
			$data[] = 'cart';
		} catch (Exception $error)
		{
			$data[] = 'error';
		}

		return view('App/Cart/index', compact($data));
	}

}
