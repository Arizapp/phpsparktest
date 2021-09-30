<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class SysBlog
 * @package App\Models
 */
class SysBlog extends AppModel
{
	public $table         = 'sys_blog';
	protected $returnType    = \App\Entities\SysBlog::class;
	protected $allowedFields = [
		'id',
		'title',
		'meta_keywords',
		'meta_description',
		'meta_og_title',
		'meta_og_description',
		'meta_og_image',
		'meta_twitter_title',
		'meta_twitter_description',
		'meta_twitter_image',
		'meta_twitter_site',
		'meta_twitter_creator',
	];

//	public function find($id = 1)
//	{
//		return $this->find($id);
//	}

}