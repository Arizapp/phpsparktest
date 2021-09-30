<?php

namespace App\Libraries\Customer;

use App\Entities\SysCustomer;
use App\Models\SysCustomers;
use Exception;

class Register
{

	/**
	 * @param array $post
	 * @throws Exception
	 */
	public function save(array $post = [])
	{
		$this->validate($post);

		$customer = (new SysCustomer())->fill($post);

		$customers = new SysCustomers();
		$id = $customers->insert($customer->toArray());

		/** @var SysCustomer $customer */
		$customer = $customers->find($id);
		if (!$customer->id) throw new Exception('Not found');

		(new Auth())->set($customer);
	}

	/**
	 * @param array $post
	 * @throws Exception
	 */
	private function validate(array &$post = [])
	{
		if (empty($post['name'])) throw new Exception('Nombre');
		if (empty($post['address'])) throw new Exception('Ubicación');
		if (empty($post['email'])) throw new Exception('E-mail');
		if (empty($post['password'])) throw new Exception('Contraseña');
		if (empty($post['password2'])) throw new Exception('Confirmar Contraseña');
		$post['password'] = trim($post['password']);
		$post['password2'] = trim($post['password2']);
		if (strlen($post['password']) < 6) throw new Exception('Contraseña chica');
		if ($post['password'] != $post['password2']) throw new Exception('Contraseñas');
	}

}