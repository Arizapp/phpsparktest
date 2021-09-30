<?php

namespace App\Models;

use App\Entities\Bairro;

/**
 * Class Bairros
 * @package App\Models
 */
class Bairros extends AppModel
{
    public    $table         = 'bairros';
    protected $returnType    = Bairro::class;
    protected $allowedFields = [
        'nome',
        'sys_city_id',
    ];

}