<?php

namespace App\Models;

use App\Entities\Imovel;

/**
 * Class Imoveis
 * @package App\Models
 */
class Imoveis extends AppModel
{
    public    $table         = 'imoveis';
    protected $returnType    = Imovel::class;
    protected $allowedFields = [
        'id',
        'sys_city_id',
        'url',
        'foto',
        'titulo',
        'bairro',
        'valor',
        'quartos',
        'area_construida',
        'area_total',
        'vagas',
        'telefone',
        'whatsapp',
        'sobre',
        'mapa',
        'youtube',
        'lancamento',
        'destaque',
        'publicado',
        'visualizacoes',
        'tipo',
    ];

    /**
     * @param $url
     * @return Imovel
     */
    public function findByUrl($url): Imovel
    {
        $row = $this->where('url', $url)->first();

        return $row ?? new Imovel();
    }

    public function find($id = null): Imovel
    {
        if (is_numeric($id)) {
            $row = parent::find($id); // se passar o ID
        } else {
            $row = $this->where('url', $id)->first(); // tentando pela URI principal
        }

        return $row ?? new Imovel();
    }

    public function search(array $fields = [
        'sys_city_id' => null,
        'bairro'      => null,
        'quartos'     => null,
        'valor'       => null,
    ], int $limit = 0, int $offset = 0): array
    {
        foreach (array_keys($fields) as $key) {
            if (!empty($fields[$key])) {
                if ($key == 'valor') {
                    $valor = (double)$fields[$key];
                    $h_val = $valor + ($valor * (20 / 100));
                    $l_val = $valor - ($valor * (20 / 100));
                    $this->where($key . ' >=', $l_val)
                         ->where($key . ' <=', $h_val);
                } else {
                    $this->where($key, $fields[$key]);
                }
            }
        }

        return $this->findAll($limit, $offset);
    }

    public function allowerFields()
    {
        return $this->allowedFields;
    }

}