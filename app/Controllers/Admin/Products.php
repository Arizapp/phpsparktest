<?php

namespace App\Controllers\Admin;

class Products extends AdminController
{

	public function index()
	{
        $view = 'Admin/Products/index';
        $data[] = 'view';

        return view($view, compact($data));
	}

}