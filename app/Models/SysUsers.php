<?php

namespace App\Models;

use App\Entities\SysUser;
use CodeIgniter\Model;

/**
 * Class SysUsersModel
 * @package App\Models
 *
 * @property int    $id
 * @property int    $admins_profile_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool   $disabled
 */
class SysUsers extends AppModel
{

	public $table         = 'sys_users';
	protected $returnType    = SysUser::class;
	protected $allowedFields = ['id', 'sys_profile_id', 'name', 'email', 'password', 'disabled'];

	/**
	 * @param $email
	 * @return SysUser
	 */
	public function findByEmail($email)
	{
		$row = $this->where('email', $email)->first();

		return $row ?? new SysUser();
	}


}