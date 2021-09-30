<?php

namespace App\Controllers\Admin;

class ProductCategories extends AdminController
{

	public function index()
	{
        $view = 'Admin/Products/categories';
        $data[] = 'view';

        return view($view, compact($data));
	}

}