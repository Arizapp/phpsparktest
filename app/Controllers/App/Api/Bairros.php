<?php

namespace App\Controllers\App\Api;


use CodeIgniter\RESTful\ResourceController;


class Bairros extends ResourceController
{

    protected $format = 'json';

    public function index()
    {
        $cidade = $this->request->getPost('cidade');
        $busca = strtolower($this->request->getPost('busca'));

        $query = "SELECT * FROM bairros";
        if (!empty($busca)) {
            $query .= " WHERE LOWER(bairro) LIKE '%{$busca}%'";

        }
        if (!empty($cidade)) {
            if (!empty($busca)) {
                $query .= " AND sys_city_id = '{$cidade}'";
            } else {
                $query .= " WHERE sys_city_id = '{$cidade}'";
            }
        }

        $db = db_connect();
        $result = $db->query($query)->getResult();


        return $this->respond($result);
    }


}