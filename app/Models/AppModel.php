<?php

namespace App\Models;

use CodeIgniter\Model;

class AppModel extends Model
{

	public function getField($name)
	{
		return $this->table . '.' . $name;
	}

}