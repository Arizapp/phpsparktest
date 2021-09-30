<?php

namespace App\Models;

use App\Entities\SysState;
use CodeIgniter\Model;

/**
 * Class StatesModel
 * @package App\Models
 *
 * @property int    $id
 * @property string $code
 * @property string $name
 */
class SysStates extends AppModel
{

	public $table         = 'sys_states';
	protected $returnType    = SysState::class;
	protected $allowedFields = ['id', 'code', 'name'];

	public function findEnabled()
	{
		return $this->select('sys_states.*')
			->join('sys_cities', 'sys_cities.sys_state_id = sys_states.id AND sys_cities.enabled <> 0')
			->orderBy('sys_states.code')
			->groupBy('sys_cities.sys_state_id')
			->findAll();
	}

}