<?php

namespace App\Controllers\Admin\Api;

use App\Models\ImoveisGallery;
use App\Models\SysProductInvoiceProducts;
use App\Models\SysProducts;
use CodeIgniter\RESTful\ResourceController;
use Config\Paths;
use Exception;

/**
 * Class Imoveis
 * @package  App\Controllers\Admin\Api
 * @property \App\Models\Imoveis $model
 */
class Imoveis extends ResourceController
{

    protected $modelName = \App\Models\Imoveis::class;
    protected $format    = 'json';

    public function index()
    {
        helper('number');

        $fields = [
            'foto',
            'id',
            'tipo',
            'titulo',
            'bairro',
            'valor',
            'telefone',
            'sys_city_id'
        ];

        $tipos = [
            'V' => 'Venda',
            'A' => 'Aluguel',
            'I' => 'Investimento',
        ];

        $recordsTotal = $this->model->countAllResults();

        /* Filters */
        $order = $this->request->getGet('order');
        if (!empty($order)) {
            $this->model->orderBy($fields[$order[0]['column']], $order[0]['dir']);
        }
        $cidade = $this->request->getGet('cidade');
        if (!empty($cidade)) {
            $this->model->where('sys_city_id', $cidade);
        }
        $tipo = $this->request->getGet('tipo');
        if (!empty($tipo)) {
            $this->model->where('tipo', $tipo);
        }
        $publicado = $this->request->getGet('publicado');
        if (isset($publicado) && $publicado != '') {
            $this->model->where('publicado', $publicado);
        }
        $search = $this->request->getGet('search');
        if (!empty($search) && !empty($search['value'])) {
            $this->model->groupStart()
                        ->like('titulo', $search['value'])
                        ->orLike('bairro', $search['value'])
                        ->orLike('telefone', $search['value'])
                        ->orLike('id', $search['value'])
                        ->groupEnd();

        }
//        dd($this->model->getCompiledSelect());

        /* Data */
        $rows = $this->model
            ->select($fields)
            ->findAll(
                $this->request->getGet('length'),
                $this->request->getGet('start')
            );
        $data = [];
        foreach ($rows as $row) {
            $row->foto = base_url('assets/img/uploads/' . $row->foto);
            $row->valor = number_to_currency($row->valor, 'BRL', 'pt-BR', 2);
            if (empty($cidade)) {
                $row->bairro = $row->bairro . ' - ' . $row->cidade->name . ' / ' . $row->cidade->state->code;
            }
            $row->edit_id = $row->id;
            $row->tipo = $tipos[$row->tipo];
            $data[] = $row;
        }

        /* Count Filtered */
        if (!empty($cidade)) {
            $this->model->where('sys_city_id', $cidade);
        }
        if (!empty($search) && !empty($search['value'])) {
            $this->model->groupStart()
                        ->like('titulo', $search['value'])
                        ->orLike('bairro', $search['value'])
                        ->orLike('telefone', $search['value'])
                        ->orLike('id', $search['value'])
                        ->groupEnd();
        }
        $recordsFiltered = $this->model->countAllResults();

        /* Result */

        return $this->respond(
            [
                'draw'            => $this->request->getGet('draw'),
                'recordsTotal'    => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data'            => $data
            ]
        );
    }

    public function create()
    {
        try {
            if ($product = $this->request->getPost()) {
                unset($product['picture']);
                if ($picture = $this->request->getFile('picture')) {
                    $imageUploadDirectory = (new Paths())->imageUploadDirectory;
                    if ($picture->isValid() && !$picture->hasMoved()) {
                        $product['picture'] = $picture->getRandomName();
                        $picture->move($imageUploadDirectory, $product['picture']);
                    }
                }
                $this->model->insert($product);
            }

            return $this->respond(true);
        }
        catch (Exception $e) {
//			if ($e->getCode() == 1062) return $this->respond(null, 500, utf8_decode("Já existe uma categoria chamada: {$name}"));

            return $this->respond(null, 500, utf8_decode($e->getMessage()) . " ({$e->getCode()})");
        }
    }

    public function update($id = null)
    {
        try {
            $product = $this->request->getPost();
            if ($id && $product) {
                unset($product['picture']);
                if ($picture = $this->request->getFile('picture')) {
                    $imageUploadDirectory = (new Paths())->imageUploadDirectory;
                    if ($picture->isValid() && !$picture->hasMoved()) {
                        $product['picture'] = $picture->getRandomName();
                        $picture->move($imageUploadDirectory, $product['picture']);
                        $SysProduct = $this->model->find($id);
                        if (isset($SysProduct->id)) $oldFile = realpath($imageUploadDirectory . DIRECTORY_SEPARATOR . $SysProduct->picture);
                    }
                }
                $this->model->update($id, $product);
                if (isset($oldFile) && is_file($oldFile)) unlink($oldFile);
            }

            return $this->respond(true);
        }
        catch (Exception $e) {
            return $this->respond(null, 500, utf8_decode($e->getMessage()));
        }
    }

    public function galleryAdd()
    {
        try {
            if ($picture = $this->request->getFile('image')) {
                $post = $this->request->getPost();
                $imageUploadDirectory = (new Paths())->imageUploadDirectory;
                if ($picture->isValid() && !$picture->hasMoved()) {
                    $post['image'] = $picture->getRandomName();
                    $picture->move($imageUploadDirectory, $post['image']);
                    $ImoveisGallery = (new ImoveisGallery());
                    $id = $ImoveisGallery->insert($post);

                    return $this->respond(
                        $ImoveisGallery->asArray()->find($id)
                    );
                }
            }

            return $this->respond(null);
        }
        catch (Exception $e) {
            return $this->respond(null, 500, utf8_decode($e->getMessage()));
        }
    }

    public function galleryDelete()
    {
        try {
            $id = $this->request->getPost('id');
            if ($id) {
                $ImoveisGallery = (new ImoveisGallery());
                $ImovelGallery = $ImoveisGallery->find($id);
                if ($ImovelGallery->id) {
                    $oldFile = realpath((new Paths())->imageUploadDirectory . DIRECTORY_SEPARATOR . $ImovelGallery->image);
                    if (file_exists($oldFile)) unlink($oldFile);
                    $ImoveisGallery->delete($id);

                    // Reorder
                    $result = $ImoveisGallery
                        ->where('imovel_id', $ImovelGallery->imovel_id)
                        ->orderBy('order')
                        ->findAll();
                    foreach ($result as $key => $row) {
                        $row->order = $key;
                        $ImoveisGallery->update($row->id, $row);
                    }

                    return $this->respond($result, 200);
                }
            }

            return $this->respond();
        }
        catch (Exception $e) {
            return $this->respond(null, 500, utf8_decode($e->getMessage()));
        }
    }

    public function galleryOrder()
    {
        try {
            $post = $this->request->getPost();
            if (isset($post['id1']) &&
                isset($post['id2']) &&
                isset($post['order1']) &&
                isset($post['order2'])
            ) {
                $ImoveisGallery = (new ImoveisGallery());
                $ImoveisGallery->update($post['id1'], ['order' => $post['order1']]);
                $ImoveisGallery->update($post['id2'], ['order' => $post['order2']]);

                return $this->respond(true);
            }

            return $this->respond();
        }
        catch (Exception $e) {
            return $this->respond(null, 500, utf8_decode($e->getMessage()));
        }
    }

    public function delete($id = null)
    {
        try {
            if ($id) {
                $count = (new SysProductInvoiceProducts())->where('sys_product_id', $id)->countAllResults();
                if ($count) throw new Exception("Existem {$count} pedidos associados a este produto.");
                $this->model->delete($id);
            }

            return $this->respond(true);
        }
        catch (Exception $e) {
            return $this->respond(null, 500, utf8_decode($e->getMessage()));
        }
    }

}