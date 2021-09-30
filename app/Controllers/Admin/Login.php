<?php

namespace App\Controllers\Admin;

use App\Libraries\Admin\Auth;
use Exception;

class Login extends AdminController
{

    public function index()
    {
        $view = 'Admin/Login/index';

        try {
            /* Start and clear session */
            $auth = new Auth();
            $auth->clear();

            /* Verify request */
            if ($post = $this->request->getPost()) {
                /* Autenticate */
                $auth->auth($post['email'], $post['password']);

                $redirect = $this->request->getGet('redirect');
                $redirect = !empty($redirect) ? urldecode($redirect) : 'admin';

                return redirect()->to(site_url($redirect ?? 'admin'));
            }
        }
        catch (Exception $error) {
            return view($view, compact('view', 'error'));
        }

        return view($view, compact('view'));
    }

    public function logout()
    {
        $auth = new Auth();
        $auth->clear();

        return redirect()->to(site_url('admin'));
    }
}