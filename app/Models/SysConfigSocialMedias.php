<?php

namespace App\Models;

use App\Entities\SysConfigSocialMedia;
use CodeIgniter\Model;

/**
 * Class ConfigSocialMediaModel
 * @package App\Models
 *
 * @property int    $id
 * @property int    $social_media_id
 * @property string $value
 */
class SysConfigSocialMedias extends AppModel
{
	public $table         = 'sys_config_social_medias';
	protected $returnType    = SysConfigSocialMedia::class;
	protected $allowedFields = ['id', 'social_media_id', 'value'];
}