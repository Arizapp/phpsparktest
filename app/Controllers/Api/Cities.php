<?php

namespace App\Controllers\Api;

use App\Entities\SysState;
use App\Models\SysCities;
use CodeIgniter\RESTful\ResourceController;

/**
 * Class Cities
 * @package App\Controllers\Api
 *
 * @property SysCities $model
 */
class Cities extends ResourceController
{
	protected $modelName = SysCities::class;
	protected $format    = 'json';

	public function byState($state_id)
	{
		$data = [];
		/** @var SysState $state */
		foreach ($this->model->findEnabled($state_id) as $state)
		{
			$data[] = $state->toArray();
		}

		return $this->respond($data);
	}
}