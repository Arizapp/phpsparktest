<?php

namespace App\Models;

use App\Entities\SysProfile;
use CodeIgniter\Model;

/**
 * Class SysProfiles
 * @package App\Models
 *
 * @property int    $id
 * @property string $name
 * @property string $description
 */
class SysProfiles extends AppModel
{
	public $table         = 'sys_profiles';
	protected $returnType    = SysProfile::class;
	protected $allowedFields = ['id', 'name', 'description'];
}