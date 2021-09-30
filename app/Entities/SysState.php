<?php

namespace App\Entities;

use App\Models\SysCities;
use CodeIgniter\Entity;

/**
 * Class State
 * @package App\Entities
 *
 * @property int       $id
 * @property string    $code
 * @property string    $name
 * @property bool      $enabled
 * @property SysCity[] $cities
 * @property SysCity[] $enabledCities
 */
class SysState extends Entity
{

	public function getCities()
	{
		return $this->findCities();
	}

	public function getEnabled()
	{
		return $this->attributes['enabled'] != '0';
	}

	public function getEnabledCities()
	{
		return $this->findCities(true);
	}

	private function findCities($enabled = false)
	{
		$property = 'cities';
		$key = 'id';

		if (!isset($this->attributes[ $property ]) && isset($this->attributes[ $key ]))
		{
			$this->attributes[ $property ] = $enabled
				? (new SysCities())->findEnabled($this->attributes[ $key ])
				: (new SysCities())->where('sys_state_id', $this->attributes[ $key ])->findAll();
		}

		return $this->attributes[ $property ] ?? [];
	}

}