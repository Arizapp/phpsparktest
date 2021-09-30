<?php

namespace App\Entities;

use CodeIgniter\Entity;

class AppEntity extends Entity
{

	public function fetchProperty($property, $key, $model, $entity) {

		if (!isset($this->attributes[ $property ]) && isset($this->attributes[ $key ]))
		{
			$this->attributes[ $property ] = (new $model)->where('id', $this->attributes[ $key ])->first();
		}

		return $this->attributes[ $property ] ?? new $entity;
	}

}