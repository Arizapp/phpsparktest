<?php

namespace App\Filters;

use App\Libraries\Admin\Auth;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuth implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!(new Auth())->verify()) {
            $uri = trim($_SERVER['REQUEST_URI'], '/');
            $uri = $uri == 'admin' ? null : $uri;

            return redirect()->to(site_url(!empty($uri) ? "admin/login?redirect={$uri}" : 'admin/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}