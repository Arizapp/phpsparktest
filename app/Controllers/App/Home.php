<?php namespace App\Controllers\App;

use App\Models\SysPages;

class Home extends AppController
{
    public function index()
    {
        $data = [];
        $page = (new SysPages())->find('home');
        $data[] = 'page';

        $imoveis_buscados = (new \App\Models\Imoveis())
            ->orderBy('visualizacoes', 'desc')
            ->findAll(3);
        $data[] = 'imoveis_buscados';

        $imoveis_destaque = (new \App\Models\Imoveis())
            ->where('destaque', '1')
            ->orderBy('visualizacoes', 'desc')
            ->findAll(4);
        $data[] = 'imoveis_destaque';

        return view('App/Home/index', compact($data));
    }

    //--------------------------------------------------------------------

}
