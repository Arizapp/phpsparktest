<?php

namespace App\Entities;

use App\Models\SysProfiles;

/**
 * Class SysUser
 * @package App\Entities
 *
 * @property int        $id
 * @property int        $sys_profile_id
 * @property string     $name
 * @property string     $email
 * @property string     $password
 * @property bool       $disabled
 * @property SysProfile $profile
 */
class SysUser extends SysBaseUser
{

	public function setDisabled($value)
	{
		$this->attributes['disabled'] = (bool)$value;

		return $this;
	}

	public function getDisabled()
	{
		return (bool)$this->attributes['disabled'];
	}

	public function setPassword(string $password)
	{
		$this->attributes['password'] = password_hash($password, PASSWORD_BCRYPT);

		return $this;
	}

	public function getProfile()
	{
		$property = 'profile';
		$key = 'sys_profile_id';

		if (!isset($this->attributes[ $property ]) && isset($this->attributes[ $key ]))
		{
			$this->attributes[ $property ] = (new SysProfiles())->where('id', $this->attributes[ $key ])->first();
		}

		return $this->attributes[ $property ] ?? new SysProfile();
	}

}