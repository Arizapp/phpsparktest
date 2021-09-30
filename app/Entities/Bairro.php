<?php

namespace App\Entities;

use App\Models\SysCities;
use CodeIgniter\Entity;

/**
 * Class Bairro
 * @package App\Entities
 *
 * @property string  $nome
 * @property int     $sys_city_id
 * @property SysCity $cidade
 */
class Bairro extends Entity
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