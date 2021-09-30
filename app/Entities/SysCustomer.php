<?php

namespace App\Entities;

/**
 * Class SysUser
 * @package App\Entities
 *
 * @property int    $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $address
 * @property bool   $disabled
 */
class SysCustomer extends SysBaseUser
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

}