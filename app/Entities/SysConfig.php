<?php

namespace App\Entities;

use App\Models\SysConfigSocialMedias;
use App\Models\SysConfigVariables;
use CodeIgniter\Entity;

/**
 * Class SysConfig
 * @package App\Entities
 *
 * @property int                    $id
 * @property string                 $favicon
 * @property string                 $title
 * @property string                 $meta_keywords
 * @property string                 $meta_description
 * @property string                 $meta_og_title
 * @property string                 $meta_og_description
 * @property string                 $meta_og_image
 * @property string                 $meta_twitter_title
 * @property string                 $meta_twitter_description
 * @property string                 $meta_twitter_image
 * @property string                 $meta_twitter_site
 * @property string                 $meta_twitter_creator
 * @property SysConfigSocialMedia[] $social_medias
 * @property SysConfigVariable[]    $variables
 */
class SysConfig extends Entity
{

	private static $_instance;

	private $_social_medias = [];
	private $_variables     = [];

	public static function getSharedInstance(): SysConfig
	{
		if (!isset(self::$_instance))
		{
			self::$_instance = (new \App\Models\SysConfig())->find();
		}

		return self::$_instance;
	}

	/**
	 * @return SysConfigSocialMedia[]
	 */
	public function getSocialMedias(): array
	{
		if (empty($this->_social_medias))
		{
			$this->_social_medias = (new SysConfigSocialMedias())->findAll();
		}

		return $this->_social_medias ?? [];
	}

	public function getVariables(): array
	{
		if (empty($this->_variables))
		{
			$rows = (new SysConfigVariables())->orderBy('order')->findAll();
			/** @var SysConfigVariable $row */
			foreach ($rows as $row)
			{
				$this->_variables[ $row->key ] = $row;
			}
		}

		return $this->_variables ?? [];
	}

}