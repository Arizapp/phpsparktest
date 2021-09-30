<?php namespace App\Controllers\App;

use App\Models\SysPages;
use Exception;

class TrabalheConosco extends AppController
{
    public function index()
    {
        $data = [];
        try {
            $page = (new SysPages())->find(uri_string());
            $data[] = 'page';
        }
        catch (Exception $error) {
            $data[] = 'error';
        }

        return view('App/TrabalheConosco/index', compact($data));
    }

}
