<?php

namespace App\Models;

use CodeIgniter\Model;

class SysConfig extends AppModel
{
	public $table         = 'sys_config';
	protected $returnType    = \App\Entities\SysConfig::class;
	protected $allowedFields = [
		'id',
		'favicon',
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

	public function allowerFields()
	{
		return $this->allowedFields;
	}

	public function find($id = 1)
	{
		return parent::find($id);
	}

}