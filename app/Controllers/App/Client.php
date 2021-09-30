<?php namespace App\Controllers\App;

use App\Models\SysCustomers;
use App\Models\SysPages;
use Exception;

class Client extends AppController
{
	public function index()
	{
		$data = [];
		try
		{
			$page = (new SysPages())->find(uri_string());
			$data[] = 'page';
			$customer = $this->auth->user();
			$data[] = 'customer';

			if ($post = $this->request->getPost())
			{
				switch ($post['action'])
				{
					case 'data':
						$this->data($post);
						break;
					case 'password':
						$this->password($post);
						break;
					default:
						throw  new Exception('Error');
				}
			}

		} catch (Exception $error)
		{
			$data[] = 'error';
		}

		return view('App/Client/index', compact($data));
	}

	/**
	 * @param $post
	 * @throws Exception
	 */
	private function data($post)
	{
		$customer = $this->auth->user();
		if (empty($post['name'])) throw new Exception('El nombre es obligatorio.', 1);
		if (empty($post['address'])) throw new Exception('La ubicación es requerida.', 1);
		if (empty($post['email'])) throw new Exception('El e-mail es obligatorio.', 1);
		if (!password_verify($post['current_password'], $customer->password)) throw new Exception('Contraseña actual inválida.', 1);

		if ($post['email'] != $customer->email)
		{
			if ((new SysCustomers())->where('email', $post['email'])->where('id !=', $customer->id)->countAllResults())
			{
				throw new Exception('Ya existe un usuario con este e-mail.', 1);
			}
		}

		$customer->name = $post['name'];
		$customer->address = $post['address'];
		$customer->email = $post['email'];
		$result = (new SysCustomers())->update($customer->id, $customer->toArray());
		if (!$result) throw new Exception('Hubo un error al guardar.', 1);
		$this->auth->set($customer);
	}

	/**
	 * @param $post
	 * @throws Exception
	 */
	private function password($post)
	{
		$customer = $this->auth->user();
		if (empty($post['password'])) throw new Exception('La nueva contraseña es requerida.', 2);
		if (empty($post['password2'])) throw new Exception('Se requiere la confirmación de la nueva contraseña.', 2);
		if ($post['password'] != $post['password2']) throw new Exception('Las nuevas contraseñas no son iguales', 2);
		if (!password_verify($post['current_password'], $customer->password)) throw new Exception('Contraseña actual inválida.', 2);

		$customer->password = $post['password'];
		$result = (new SysCustomers())->update($customer->id, $customer);
		if (!$result) throw new Exception('Hubo un error al guardar.', 2);
		$this->auth->set($customer);
	}

}
