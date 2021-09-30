<?php

namespace App\Controllers\Admin;

class Customer extends AdminController
{

	public function index()
	{

        $view = 'Admin/Customer/index';
        $data[] = 'view';

        return view($view, compact($data));
	}

}