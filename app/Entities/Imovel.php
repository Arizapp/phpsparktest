<?php

namespace App\Entities;

use App\Models\SysCities;
use CodeIgniter\Entity;

/**
 * Class SysPage
 * @package App\Entities
 *
 * @property int     $id
 * @property int     $sys_city_id
 * @property string  $url
 * @property string  $foto
 * @property string  $titulo
 * @property string  $bairro
 * @property double  $valor
 * @property int     $quartos
 * @property string  $area_construida
 * @property string  $area_total
 * @property int     $vagas
 * @property string  $telefone
 * @property string  $whatsapp
 * @property string  $sobre
 * @property string  $mapa
 * @property string  $youtube
 * @property string  $tipo
 * @property int     $visualizacoes
 * @property int     $lancamento
 * @property SysCity $cidade
 */
class Imovel extends Entity
{

    public function getCidade()
    {
        $property = 'cidade';
        $key = 'sys_city_id';

        if (!isset($this->attributes[$property]) && isset($this->attributes[$key])) {
            $this->attributes[$property] = (new SysCities())->where('id', $this->attributes[$key])->first();
        }

        return $this->attributes[$property] ?? new SysCity();
    }

}