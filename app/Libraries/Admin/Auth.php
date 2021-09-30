<?php

namespace App\Libraries\Admin;

use App\Entities\SysBaseUser;
use App\Entities\SysUser;
use App\Libraries\BaseAuth;
use App\Models\SysUsers;
use CodeIgniter\Session\Session;
use Exception;

/**
 * Class Auth
 * @package App\Libraries\Admin
 *
 * @property Session $session
 */
class Auth extends BaseAuth
{
	private static $_instance;

	const ERROR_PASSWORD = 1;
	const ERROR_DISABLED = 2;

	const PROFILE_SUPER = 1;
	const PROFILE_ADMIN = 2;
	const PROFILE_USER  = 3;

	protected $session_name = 'admin';

	public static function getSharedInstance(): Auth
	{
		if (!isset(self::$_instance))
		{
			self::$_instance = new Auth();
		}

		return self::$_instance;
	}

	public function isSuper(): bool
	{
		return $this->user()->profile->id == self::PROFILE_SUPER;
	}

	public function isAdmin(): bool
	{
		return $this->user()->profile->id == self::PROFILE_ADMIN || $this->user()->profile->id == self::PROFILE_SUPER;
	}

	/**
	 * @return SysUser
	 */
	public function user(): SysBaseUser
	{
		return parent::user();
	}

	/**
	 * @param string $email
	 * @param string $password
	 * @return SysUser
	 * @throws Exception
	 */
	public function auth(string $email, string $password)
	{
		$user = (new SysUsers())->findByEmail($email);
		if (!password_verify($password, $user->password))
		{
			throw new Exception(lang('Auth.Error.password'), self::ERROR_PASSWORD);
		}
		if ($user->disabled)
		{
			throw new Exception(lang("Auth.Error.disabled"), self::ERROR_DISABLED);
		}

		$this->set($user);

		return $user;
	}

}