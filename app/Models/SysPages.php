<?php

namespace App\Models;

use App\Entities\SysPage;

/**
 * Class SysPages
 * @package App\Models
 */
class SysPages extends AppModel
{
	public    $table         = 'sys_pages';
	protected $returnType    = SysPage::class;
	protected $allowedFields = [
		'id',
		'uri',
		'route',
		'route_filter',
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

	public function findByUri($uri): SysPage
	{
		$row = $this->where('uri', $uri)->first();

		return $row ?? new SysPage();
	}

	public function find($id = null): SysPage
	{
		if (is_numeric($id))
		{
			$row = parent::find($id); // se passar o ID
		} else
		{
			$row = $this->where('uri', $id)->first(); // tentando pela URI principal
			if (!$row)
			{
				// buscar por apelido
				$row = $this
					->select('sys_pages.*')
					->join('sys_pages_uris', 'sys_pages_uris.sys_page_id = sys_pages.id')
					->where('sys_pages_uris.uri', $id)
					->first();
			}
		}

		return $row ?? new SysPage();
	}

	public function allowerFields()
	{
		return $this->allowedFields;
	}

}