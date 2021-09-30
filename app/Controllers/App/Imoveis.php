<?php namespace App\Controllers\App;

use App\Models\ImoveisGallery;
use App\Models\SysPages;
use Exception;

class Imoveis extends AppController
{

    public function index()
    {
        $data = [];
        try {
            $page = (new SysPages())->find('imovel');
            $data[] = 'page';

            $imoveis = (new \App\Models\Imoveis());

            $imovel = $imoveis->findByUrl(ltrim(uri_string(), 'imovel/'));
            $data[] = 'imovel';

            $fotos = (new ImoveisGallery())->findByImovel($imovel->id);
            $data[] = 'fotos';

            $imoveis->update($imovel->id, [
                'visualizacoes' => ((int)$imovel->visualizacoes + 1)
            ]);

        }
        catch (Exception $error) {
            $data[] = 'error';
        }

        return view('App/Imoveis/index', compact($data));
    }

    public function busca()
    {
        $data = [];
        try {
            $page = (new SysPages())->find(uri_string());
            $data[] = 'page';

            $Imoveis = (new \App\Models\Imoveis());

            $cidade = $this->request->getGet('cidade');
            if (!empty($cidade)) {
                $Imoveis->where('sys_city_id', $cidade);
            }
            $bairro = $this->request->getGet('bairro');
            if (!empty($bairro)) {
                $Imoveis->where('bairro', $bairro);
            }
            $quartos = $this->request->getGet('quartos');
            if (!empty($quartos)) {
                if ($quartos == '5') $Imoveis->where('quartos >=', 5);
                else $Imoveis->where('quartos', $quartos);
            }
            $valor = (int)$this->request->getGet('valor') * 1000;
            if (!empty($valor)) {
                if ($valor == 999000) $Imoveis->where('valor >=', 550000);
                elseif ($valor == 150000) $Imoveis->where('valor <=', $valor);
                else $Imoveis->where('valor <=', $valor)->where('valor >=', $valor - 100000);
            }

            $imoveis = $Imoveis->where('publicado', '1')->findAll();

            $data[] = 'imoveis';
        }
        catch (Exception $error) {
            $data[] = 'error';
        }

        return view('App/Imoveis/comprar', compact($data));
    }

    public function comprar()
    {
        $data = [];
        try {
            $page = (new SysPages())->find(uri_string());
            $data[] = 'page';

            $imoveis = (new \App\Models\Imoveis())
                ->where('tipo', 'V')
                ->where('publicado', '1')
                ->findAll();
            $data[] = 'imoveis';

        }
        catch (Exception $error) {
            $data[] = 'error';
        }

        return view('App/Imoveis/comprar', compact($data));
    }

    public function alugar()
    {
        $data = [];
        try {
            $page = (new SysPages())->find(uri_string());
            $data[] = 'page';

            $imoveis = (new \App\Models\Imoveis())
                ->where('tipo', 'A')
                ->where('publicado', '1')
                ->findAll();
            $data[] = 'imoveis';

        }
        catch (Exception $error) {
            $data[] = 'error';
        }

        return view('App/Imoveis/alugar', compact($data));
    }

    public function investir()
    {
        $data = [];
        try {
            $page = (new SysPages())->find(uri_string());
            $data[] = 'page';

            $imoveis = (new \App\Models\Imoveis())
                ->where('tipo', 'I')
                ->where('publicado', '1')
                ->findAll();
            $data[] = 'imoveis';

        }
        catch (Exception $error) {
            $data[] = 'error';
        }

        return view('App/Imoveis/investir', compact($data));
    }

}
