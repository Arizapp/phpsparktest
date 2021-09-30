<?php

namespace App\Models;

use App\Entities\SysCity;

/**
 * Class CitiesModel
 * @package App\Models
 *
 * @property int    $id
 * @property int    $sys_state_id
 * @property string $name
 * @property double $latitude
 * @property double $longitude
 * @property bool   $capital
 * @property bool   $enabled
 */
class SysCities extends AppModel
{
	public    $table         = 'sys_cities';
	protected $returnType    = SysCity::class;
	protected $allowedFields = ['id', 'sys_state_id', 'name', 'latitude', 'longitude', 'capital', 'enabled'];

	public function findEnabled($state = null)
	{
		if ($state) $this->where('sys_cities.sys_state_id', $state);

		return $this
            ->select('sys_cities.*')
			->where('sys_cities.enabled <>', 0)
            ->join('sys_states', 'sys_states.id = sys_cities.sys_state_id')
			->orderBy('sys_states.name')
			->orderBy('sys_cities.capital', 'desc')
			->orderBy('sys_cities.name')
			->findAll();
	}

	/**
	 * @return SysCity[]
	 */
	public function getAreaDeCobertura()
	{
		return $this->whereIn('id', [
			'5208707', // Goiânia
			'5221403', // Trindade
		])->orderBy('name')->findAll();
	}

}