<?php

namespace App\Controllers\Admin;

use App\Models\SysProfiles;
use App\Models\SysUsers;
use Exception;

class Users extends AdminController
{

	public function index()
	{
		try
		{
			if ($post = $this->request->getPost())
			{
				(new \App\Libraries\Admin\Users())->update($post);
			}

			$data = [];
			if ($error = session()->getFlashdata('error'))
			{
				$data[] = 'error';
			}
		} catch (Exception $ex)
		{
			$error = $ex->getMessage();
			$data[] = 'error';
		} finally
		{
			$users = (new SysUsers())->findAll();
			$data[] = 'users';

			$profiles = (new SysProfiles())->findAll();
			$data[] = 'profiles';
		}

        $view = 'Admin/Users/index';
        $data[] = 'view';

        return view($view, compact($data));
	}

	public function del($id)
	{
		if ($id > 1) (new SysUsers())->delete($id);

		return redirect()->to(site_url('admin/usuarios'));
	}

	public function add()
	{
		try
		{
			if ($email = $this->request->getPost('email'))
			{
				(new \App\Libraries\Admin\Users())->add($email);
			}
		} catch (Exception $ex)
		{
			session()->setFlashdata('error', $ex->getMessage());
		}

		return redirect()->to(site_url('admin/usuarios'));
	}

}