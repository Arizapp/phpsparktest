<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Imoveis extends ResourceController
{

    protected $modelName = \App\Models\Imoveis::class;
    protected $format    = 'json';

    public function index()
    {
        return $this->respond(
            $this->model
                ->findAll()
        );
    }


}