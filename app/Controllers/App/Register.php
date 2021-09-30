<?php namespace App\Controllers\App;

use App\Models\SysPages;
use Exception;

class Register extends AppController
{
	public function index()
	{
		$data = [];
		try
		{
			$page = (new SysPages())->find(uri_string());
			$data[] = 'page';

			/* Verify request */
			if ($post = $this->request->getPost())
			{
				$data[] = 'post';
				(new \App\Libraries\Customer\Register())->save($post);

				return redirect()->to(site_url('nuevo-pedido'));
			}
		} catch (Exception $error)
		{
			$data[] = 'error';
		}

		return view('App/Register/index', compact($data));
	}

}
