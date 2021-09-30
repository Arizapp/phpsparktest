<?php namespace App\Controllers\App;

use App\Models\SysPages;
use Exception;

class Simulador extends AppController
{
    public function index()
    {
        $data = [];
        try {
            $page = (new SysPages())->find(uri_string());
            $data[] = 'page';
        } catch (Exception $error) {
            $data[] = 'error';
        }

        return view('App/Simulador/index', compact($data));
    }

    public function idade()
    {
        $data = [];
        try {
            $page = (new SysPages())->find(uri_string());
            $data[] = 'page';
        } catch (Exception $error) {
            $data[] = 'error';
        }

        return view('App/Simulador/idade', compact($data));
    }

}
