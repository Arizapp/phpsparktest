<?php

namespace App\Controllers\Admin;

use Config\Services;

class Home extends AdminController
{
	public function index()
	{
		return redirect()->to(site_url('admin/imoveis'));
	}
}