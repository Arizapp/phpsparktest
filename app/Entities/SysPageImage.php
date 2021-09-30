<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * Class SysPageImage
 * @package App\Entities
 *
 * @property int             $id
 * @property SysPageVariable $sys_page_variable_id
 * @property string          $image
 * @property string          $title
 * @property string          $description
 * @property string          $url
 * @property bool            $url_external
 */
class SysPageImage extends Entity
{
	public function getImage()
	{
		return site_url("assets/img/uploads/{$this->attributes['image']}");
	}

	public function getImageName()
	{
		return $this->attributes['image'];
	}

	public function getUrlExternal(): bool
	{
		return (bool)$this->attributes['url_external'];
	}

	public function setUrlExternal(bool $url_external): void
	{
		$this->attributes['url_external'] = $url_external ? 1 : 0;
	}


}