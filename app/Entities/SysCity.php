<?php

namespace App\Entities;

use App\Models\SysStates;
use CodeIgniter\Entity;

/**
 * Class City
 * @package App\Entities
 *
 * @property int      $id
 * @property int      $sys_state_id
 * @property string   $name
 * @property double   $latitude
 * @property double   $longitude
 * @property bool     $capital
 * @property string   $picture
 * @property bool     $enabled
 * @property SysState $state
 */
class SysCity extends Entity
{
	public function getState()
	{
		$property = 'state';
		$key = 'sys_state_id';

		if (!isset($this->attributes[ $property ]) && isset($this->attributes[ $key ]))
		{
			$this->attributes[ $property ] = (new SysStates())->where('id', $this->attributes[ $key ])->first();
		}

		return $this->attributes[ $property ] ?? new SysState();
	}

	public function getEnabled()
	{
		return $this->attributes['enabled'] != '0';
	}

	public function getCapital()
	{
		return $this->attributes['capital'] != '0';
	}
}