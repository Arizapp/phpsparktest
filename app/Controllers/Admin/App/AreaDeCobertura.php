<?php namespace App\Controllers\Admin\App;

use App\Controllers\Admin\AdminController;
use App\Models\AreasDeCobertura;
use App\Models\SysCities;
use Exception;

class AreaDeCobertura extends AdminController
{

	public function index()
	{
		try
		{
			$data = [];
			$cidades = (new SysCities())->getAreaDeCobertura();
			$data[] = 'cidades';
		} catch (Exception $ex)
		{
			$error = $ex->getMessage();
			$data[] = 'error';
		}

		return view('Admin/App/AreaDeCobertura/index', compact($data));
	}

	public function bairros($sys_city_id)
	{
		$bairros = (new AreasDeCobertura())->findByCity($sys_city_id, true);

		return $this->response->setJSON([
			'bairros' => $bairros,
			'csrf'    => [
				'token' => csrf_token(),
				'hash'  => csrf_hash(),
			],
		]);
	}

	public function bairros_del($id)
	{
		(new AreasDeCobertura())->delete($id);
	}

	public function bairros_add()
	{
		$sys_city_id = $this->request->getPost('sys_city_id');
		$bairro = $this->request->getPost('bairro');
		(new AreasDeCobertura())->insert([
			'bairro'      => $bairro,
			'sys_city_id' => $sys_city_id,
		]);
	}

}