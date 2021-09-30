<?php namespace App\Controllers\App;

use App\Models\SysPages;
use Exception;

class Builder extends AppController
{
	public function index()
	{
		$data = [];
		try
		{
			(new \App\Libraries\Builder\Cart())->clear();
			$page = (new SysPages())->find(uri_string());
			$data[] = 'page';
		} catch (Exception $error)
		{
			$data[] = 'error';
		}

		return view('App/Builder/index', compact($data));
	}

}
