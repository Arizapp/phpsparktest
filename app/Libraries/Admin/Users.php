<?php

namespace App\Libraries\Admin;

use App\Entities\SysUser;
use App\Models\SysUsers;
use Exception;
use ReflectionException;

class Users
{
	/**
	 * @param $post
	 * @throws ReflectionException
	 * @throws Exception
	 */
	public function update($post)
	{
		$SysUsers = new SysUsers();
		foreach ($post['users'] as $item)
		{
			/** @var SysUser $user */
			$user = $SysUsers->find($item['id']);
			if ($user->id)
			{
				/** @var SysUser $user2 */
				$user2 = $SysUsers
					->where('email', $item['email'])
					->where('id <>', $item['id'])
					->first();
				if ($user2 && $user2->id && $user2->id != $user->id)
					throw new Exception("Não é possível alterar o e-mail do usuário {$item['name']} para {$item['email']} pois já existe um usuário com este e-mail!");
				$user->name = $item['name'];
				$user->email = $item['email'];
				$user->sys_profile_id = $item['sys_profile_id'];
				if (!empty($item['password'])) $user->password = $item['password'];
				$user->disabled = empty($item['disabled']) ? 0 : 1;
				$SysUsers->save($user);
			}
		}
	}

	/**
	 * @param $email
	 * @throws ReflectionException
	 * @throws Exception
	 */
	public function add($email)
	{
		$SysUsers = new SysUsers();
		/** @var SysUser $user */
		$user = $SysUsers->where('email', $email)->first();
		if ($user->id) throw new Exception('Já existe outro usuário com este e-mail!');

		$name = current(explode('@', $email));
		(new SysUsers())->insert([
			'name'           => $name,
			'email'          => $email,
			'sys_profile_id' => 3,
			'disabled'       => 1,
		]);
	}
}