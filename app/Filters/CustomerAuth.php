<?php

namespace App\Filters;

use App\Libraries\Customer\Auth;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CustomerAuth implements FilterInterface
{

	public function before(RequestInterface $request, $arguments = null)
	{
		if (!(new Auth())->verify())
		{
			$uri = trim($_SERVER['REQUEST_URI'], '/');

			return redirect()->to(site_url(!empty($uri) ? "iniciar-sesion?redirect={$uri}" : 'iniciar-sesion'));
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// TODO: Implement after() method.
	}
}