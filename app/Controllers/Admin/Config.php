<?php

namespace App\Controllers\Admin;

use App\Libraries\Admin\Config as ConfigLibrary;
use App\Models\SysConfig;
use App\Models\SysSocialMedias;
use Exception;

class Config extends AdminController
{

	public function index()
	{
		try
		{
			$data = [];

			$social_medias = (new SysSocialMedias())->findAll();
			$data[] = 'social_medias';

			/** @var \App\Entities\SysConfig $config */
			$config = (new SysConfig())->find();
			$data[] = 'config';

			/* Verify request */
			if ($post = $this->request->getPost())
			{
				(new ConfigLibrary())->edit($config, $post, $this->request->getFiles());
			}
		} catch (Exception $ex)
		{
			$error = $ex->getMessage();
			$data[] = 'error';
		}

        $view = 'Admin/Config/edit';
        $data[] = 'view';

        return view($view, compact($data));
	}

}