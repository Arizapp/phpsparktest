<?php

namespace App\Controllers\Admin;

use App\Models\ImoveisGallery;
use App\Models\SysCities;
use Exception;

class Imoveis extends AdminController
{

    public function index(): string
    {
        $view = 'Admin/Imoveis/index';
        $data[] = 'view';

        $cidade = $this->request->getGet('cidade');
        $data[] = 'cidade';
        $tipo = $this->request->getGet('tipo');
        $data[] = 'tipo';
        $publicado = $this->request->getGet('publicado');
        if (is_numeric($publicado)) $data[] = 'publicado';

        $db = db_connect();
        $cidades = $db->query('SELECT * FROM cidades')->getResult();
        $data[] = 'cidades';

        return view($view, compact($data));
    }

    public function create()
    {
        $view = 'Admin/Imoveis/create';
        $data[] = 'view';

        $cities = (new SysCities())->findEnabled();
        $cidades = [];
        $lastState = null;
        /** @var $cities \App\Entities\SysCity[] */
        foreach ($cities as $city) {
            if ($lastState != $city->state->name) {
                $lastState = $city->state->name;
            }
            $cidades[$lastState][] = $city;
        }
        $data[] = 'cidades';

        $form = $this->request->getPost();
        $data[] = 'form';
        if (!empty($form)) {
            try {
                $id = (new \App\Libraries\Admin\Imoveis())->insert($form, $this->request->getFiles());

                return redirect()->to(site_url("admin/imovel/{$id}"));
            }
            catch (Exception $e) {
                $error = [
                    'title'   => 'Ocorreu um erro ao adicionar o imóvel.',
                    'message' => $e->getMessage()
                ];
                $data[] = 'error';
            }
        }


        return view($view, compact($data));
    }

    public function edit(int $id)
    {
        $view = 'Admin/Imoveis/edit';
        $data[] = 'view';


        $form = $this->request->getPost();
        if (!empty($form)) {
            try {
                (new \App\Libraries\Admin\Imoveis())->update($id, $form, $this->request->getFiles());
            }
            catch (Exception $e) {
                $error = [
                    'title'   => 'Ocorreu um erro ao adicionar o imóvel.',
                    'message' => $e->getMessage()
                ];
                $data[] = 'error';
            }
        }

        if (!isset($error)) {
            $imovel = (new \App\Models\Imoveis())->find($id);
            if (!$imovel->id) {
                return redirect()->to(site_url('admin/imoveis'));
            }
            $form = $imovel->toArray();
        }

        $data[] = 'form';

        $cities = (new SysCities())->findEnabled();
        $cidades = [];
        $lastState = null;
        /** @var $cities \App\Entities\SysCity[] */
        foreach ($cities as $city) {
            if ($lastState != $city->state->name) {
                $lastState = $city->state->name;
            }
            $cidades[$lastState][] = $city;
        }
        $data[] = 'cidades';

        $fotos = (new ImoveisGallery())->findByImovel($id, true);
        $data[] = 'fotos';

        return view($view, compact($data));
    }



}