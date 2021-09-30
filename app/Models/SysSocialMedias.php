<?php

namespace App\Models;

use App\Entities\SysSocialMedia;
use CodeIgniter\Model;

/**
 * Class SocialMediaModel
 * @package App\Models
 *
 * @property int    $id
 * @property string $name
 * @property string $icon
 */
class SysSocialMedias extends AppModel
{
	public $table         = 'sys_social_medias';
	protected $returnType    = SysSocialMedia::class;
	protected $allowedFields = ['id', 'name', 'icon'];
}