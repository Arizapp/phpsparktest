<?php

namespace App\Controllers\App;

use App\Models\SysPages;
use Exception;

class Login extends AppController
{

	public function index()
	{
		$data = [];
		try
		{
			$page = (new SysPages())->find(uri_string());
			$data[] = 'page';

			/* Start and clear session */
			$this->auth->clear();

			/* Verify request */
			if ($post = $this->request->getPost())
			{
				/* Autenticate */
				$this->auth->auth($post['email'], $post['password']);

				$redirect = $this->request->getGet('redirect');
				$redirect = !empty($redirect) ? urldecode($redirect) : 'mis-pedidos';

				return redirect()->to(site_url($redirect));
			}
		} catch (Exception $error)
		{
			$data[] = 'error';
		}

		return view('App/Login/index', compact($data));
	}

	public function logout()
	{
		$this->auth->clear();

		return redirect()->to(site_url('/'));
	}
}