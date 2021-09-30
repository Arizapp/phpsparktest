<?php

namespace App\Models;

use App\Entities\SysConfigVariable;
use CodeIgniter\Model;

/**
 * Class SysConfigVariables
 * @package App\Models
 *
 * @property int    $id
 * @property string $type
 * @property string $key
 * @property string $value
 * @property int    $order
 */
class SysConfigVariables extends AppModel
{
	public $table         = 'sys_config_variables';
	protected $returnType    = SysConfigVariable::class;
	protected $allowedFields = ['id', 'type', 'key', 'value', 'order'];
}