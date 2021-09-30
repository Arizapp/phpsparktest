<?php

namespace App\Models;

use App\Entities\SysCustomer;
use App\Entities\SysUser;

class SysCustomers extends AppModel
{

	public    $table         = 'sys_customers';
	protected $returnType    = SysCustomer::class;
	protected $allowedFields = [
		'id',
		'sys_profile_id',
		'name',
		'email',
		'address',
		'password',
		'disabled',
	];

	/**
	 * @param $email
	 * @return SysCustomer
	 */
	public function findByEmail($email)
	{
		return $this->where('email', $email)->first() ?? new SysCustomer();
	}

}