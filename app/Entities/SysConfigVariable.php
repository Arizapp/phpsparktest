<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * Class SysConfigVariable
 * @package App\Entities
 *
 * @property int    $id
 * @property string $type
 * @property string $key
 * @property string $value
 * @property int    $order
 */
class SysConfigVariable extends Entity
{
	const TYPE_IMAGE     = 'I';
	const TYPE_TEXT      = 'T';
	const TYPE_MULTITEXT = 'M';
	const TYPE_RICHTEXT  = 'R';
	const TYPE_CODE      = 'C';

	public static function listTypes()
	{
		return [
			self::TYPE_TEXT      => 'Texto',
			self::TYPE_MULTITEXT => 'Texto em linhas',
			self::TYPE_IMAGE     => 'Imagem',
			self::TYPE_CODE      => 'Código',
//			self::TYPE_RICHTEXT  => 'Editor',
		];
	}

	public function __toString()
	{
		switch ($this->type)
		{
			case self::TYPE_IMAGE:
				return site_url("assets/img/uploads/{$this->value}");
			case self::TYPE_MULTITEXT:
				return nl2br($this->value);
			default:
				return $this->value;
		}
	}

}