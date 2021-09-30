<?php

namespace App\Entities;

use App\Models\SysSocialMedias;
use CodeIgniter\Entity;

/**
 * Class ConfigSocialMedia
 * @package App\Entities
 *
 * @property int            $id
 * @property int            $social_media_id
 * @property string         $value
 * @property SysSocialMedia $social_media
 */
class SysConfigSocialMedia extends Entity
{

	public function getSocialMedia()
	{
		$property = 'social_media';
		$key = 'social_media_id';

		if (!isset($this->attributes[ $property ]) && isset($this->attributes[ $key ]))
		{
			$this->attributes[ $property ] = (new SysSocialMedias())->where('id', $this->attributes[ $key ])->first();
		}

		return $this->attributes[ $property ] ?? [];
	}

}