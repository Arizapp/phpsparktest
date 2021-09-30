<?php

namespace App\Entities;

use App\Models\SysPagesUris;
use App\Models\SysPagesVariables;
use CodeIgniter\Entity;

/**
 * Class SysPage
 * @package App\Entities
 *
 * @property int               $id
 * @property string            $uri
 * @property string            $route
 * @property string            $route_filter
 * @property string            $title
 * @property string            $meta_keywords
 * @property string            $meta_description
 * @property string            $meta_og_title
 * @property string            $meta_og_description
 * @property string            $meta_og_image
 * @property string            $meta_twitter_title
 * @property string            $meta_twitter_description
 * @property string            $meta_twitter_image
 * @property string            $meta_twitter_site
 * @property string            $meta_twitter_creator
 * @property string            $image
 * @property SysPageUri[]      $uris
 * @property SysPageVariable[] $variables
 */
class SysPage extends Entity
{
	private $_uris      = [];
	private $_variables = [];

	public function getUris(): array
	{
		if (empty($this->_uris))
		{
			$this->_uris = (new SysPagesUris())->where('sys_page_id', $this->attributes['id'])->findAll();
		}

		return $this->_uris ?? [];
	}

	public function getVariables(): array
	{
		if (empty($this->_variables))
		{
			$rows = (new SysPagesVariables())->where('sys_page_id', $this->attributes['id'])->orderBy('order')->findAll();
			/** @var SysPageVariable $row */
			foreach ($rows as $row)
			{
				$this->_variables[ $row->key ] = $row;
			}
		}

		return $this->_variables ?? [];
	}

}