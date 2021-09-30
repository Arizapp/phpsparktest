<?php

namespace App\Models;

use App\Entities\SysPageVariable;
use CodeIgniter\Model;

/**
 * Class PagesVariables
 * @package App\Models
 *
 * @property int    $id
 * @property int    $sys_page_id
 * @property string $type
 * @property string $key
 * @property string $value
 * @property int    $order
 */
class SysPagesVariables extends AppModel
{
	public $table         = 'sys_pages_variables';
	protected $returnType    = SysPageVariable::class;
	protected $allowedFields = ['id', 'sys_page_id', 'type', 'key', 'value', 'order'];
}