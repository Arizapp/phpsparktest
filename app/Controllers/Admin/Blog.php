<?php

namespace App\Controllers\Admin;

use App\Libraries\Admin\Page;
use App\Models\SysBlog;
use App\Models\SysBlogCategories;
use Exception;

class Blog extends AdminController
{

    public function index()
    {
        $data = [];
        /** @var \App\Entities\SysBlog $blog */
        $blog = (new SysBlog())->first();
        $data[] = 'blog';
        $categories = (new SysBlogCategories())->findAll();
        $data[] = 'categories';
        $tab = $this->request->getPost('tab') ?? 'general';
        $data[] = 'tab';

        $view = 'Admin/Blog/edit';
        $data[] = 'view';

        return view($view, compact($data));
    }

    public function new()
    {
        try {
            $data = [];

            /* Verify request */
            if ($post = $this->request->getPost()) {
                $data[] = 'post';
                $uri = (new Page())->new($post);

                return redirect()->to(site_url('admin/pagina/' . $uri));
            }
        }
        catch (Exception $ex) {
            dd($ex);
            $error = $ex->getMessage();
            $data[] = 'error';
        }

        $view = 'Admin/Pages/new';
        $data[] = 'view';

        return view($view, compact($data));
    }

    public function edit($uri)
    {
        try {
            $data = [];

            $blog = (new SysBlog())->first();
            $data[] = 'blog';
            $tab = $this->request->getPost('tab') ?? 'general';
            $data[] = 'tab';
//			$page = $SysBlog->find($uri);
//			$data[] = 'page';
//			if (!$page) throw new Exception("Página '{$uri}' não encontrada!");
//
//			/** @var SysConfig[] $pages */
//			$pages = $SysBlog->orderBy('uri')->findAll();
//			$data[] = 'pages';
//
//			/* Verify request */
//			if ($post = $this->request->getPost())
//			{
//				(new Page())->edit($page, $post, $this->request->getFiles());
//			}
        }
        catch (Exception $ex) {
            $error = $ex->getMessage();
            $data[] = 'error';
        }

        $view = 'Admin/Blog/edit';
        $data[] = 'view';

        return view($view, compact($data));
    }

    public function posts()
    {

    }

}