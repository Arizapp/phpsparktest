<?php

namespace App\Controllers\Admin;

class Language extends AdminController
{
	public function index($uri = '')
	{
		$session = session();
		$session->remove('language');
		$session->set('language', $this->request->getLocale());

		return redirect()->to(base_url($uri));
	}
}