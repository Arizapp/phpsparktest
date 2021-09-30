<?php namespace App\Controllers\App;

use App\Models\SysPages;

class Contato extends AppController
{
    public function index()
    {
        $page = (new SysPages())->find('contato');

        return view('App/Contato/index', compact('page'));
    }

    public function enviar()
    {


        return $this->response->setJSON(null);
//        return $this->response->setStatusCode(503)->setBody('Deu pau');

    }

    //--------------------------------------------------------------------

}
