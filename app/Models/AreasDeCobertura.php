<?php

namespace App\Models;

use App\Entities\AreaDeCobertura;

class AreasDeCobertura extends AppModel
{

	public    $table         = 'areas_de_cobertura';
	protected $returnType    = AreaDeCobertura::class;
	protected $allowedFields = [
		'id',
		'sys_city_id',
		'bairro',
	];

	/**
	 * @param      $sys_city_id
	 * @param bool $asArray
	 * @return AreaDeCobertura[]|array
	 */
	public function findByCity($sys_city_id, $asArray = false)
	{
		$result = $this
			->where('sys_city_id', $sys_city_id)
			->orderBy('bairro')
			->findAll();
		if (!$asArray) return $result;

		$data = [];
		foreach ($result as $row)
		{
			$data[] = $row->toArray();
		}

		return $data;
	}

}