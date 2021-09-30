<?php

namespace App\Controllers;

use App\Models\SysBlogPosts;

class Blog extends AppController
{
	public function index()
	{
		dd('Blog/index');
	}

	public function post($uri)
	{
		$post = (new SysBlogPosts())->findByUri($uri);

		dd($post);
	}
}