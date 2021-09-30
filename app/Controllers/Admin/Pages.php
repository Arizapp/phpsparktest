<?php

namespace App\Controllers\Admin;

use App\Entities\SysConfig;
use App\Libraries\Admin\Page;
use App\Models\SysPages;
use Exception;

class Pages extends AdminController
{

    public function index()
    {
        $data = [];

        $pages = (new SysPages())->orderBy('uri')->findAll();
        $data[] = 'pages';

        $view = 'Admin/Pages/index';
        $data[] = 'view';

        return view($view, compact($data));
    }

    public function delete($id)
    {
        try {
            (new Page())->delete($id);
        }
        catch (Exception $ex) {
            $error = $ex->getMessage();
            dd($ex);
        }

        return redirect()->to(site_url('admin/paginas'));
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
            $error = $ex->getMessage();
            $data[] = 'error';
        }

        $view = 'Admin/Pages/new';
        $data[] = 'view';

        return view($view, compact($data));
    }

    public function edit(...$uri)
    {
        $uri = implode('/', $uri);
        try {
            $data = [];

            $SysPages = new SysPages();
            $page = $SysPages->find($uri);
            $data[] = 'page';
            if (!$page) throw new Exception("Página '{$uri}' não encontrada!");

            /** @var SysConfig[] $pages */
            $pages = $SysPages->orderBy('uri')->findAll();
            $data[] = 'pages';

            /* Verify request */
            if ($post = $this->request->getPost()) {
                $current_uri = $page->uri;
                (new Page())->edit($page, $post, $this->request->getFiles());
                $new_uri = $page->uri;
                if ($current_uri !== $new_uri) {
                    return redirect()->to(site_url("admin/pagina/{$new_uri}"), null, 'refresh');
                }
            }
        }
        catch (Exception $ex) {
            $error = $ex->getMessage();
            $data[] = 'error';
        }

        $view = 'Admin/Pages/edit';
        $data[] = 'view';

        return view($view, compact($data));
    }

}