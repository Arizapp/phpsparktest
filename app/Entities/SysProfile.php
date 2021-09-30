<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * Class SysProfile
 * @package App\Entities
 *
 * @property int    $id
 * @property string $name
 */
class SysProfile extends Entity
{

	public function isSuper()
	{
		return $this->attributes['id'] == 1;
	}

	public function isAdministrador()
	{
		return $this->attributes['id'] == 2;
	}

	public function isUsuario()
	{
		return $this->attributes['id'] == 3;
	}

}