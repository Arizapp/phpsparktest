<?php

namespace App\Libraries;

use App\Entities\SysBaseUser;
use CodeIgniter\Config\Services;

class BaseAuth
{
	protected $session_name = 'base_auth';

	private $session;
	private $user;

	public function __construct()
	{
		$this->session = Services::session();
	}

	public function verify()
	{
		return $this->session->has($this->session_name);
	}

	public function user(): SysBaseUser
	{
		if (empty($this->user) && !($this->user instanceof SysBaseUser))
		{
			$user = unserialize($this->session->get($this->session_name));
			$this->user = $user instanceof SysBaseUser ? $user : new SysBaseUser();
		}

		return $this->user;
	}

	public function isLogged(): bool
	{
		return (bool)$this->user()->id;
	}

	public function set(SysBaseUser $user)
	{
		$this->session->set($this->session_name, serialize($user));

		return $this;
	}

	public function clear()
	{
		$this->user = null;
		$this->session->remove($this->session_name);
	}

	public function auth(string $username, string $password)
	{
	}
}