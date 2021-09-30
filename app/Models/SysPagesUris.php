<?php

namespace App\Models;

use App\Entities\SysPageUri;
use CodeIgniter\Model;

/**
 * Class PagesUris
 * @package App\Models
 *
 * @property int    $id
 * @property int    $sys_page_id
 * @property string $uri
 */
class SysPagesUris extends AppModel
{
	public $table         = 'sys_pages_uris';
	protected $returnType    = SysPageUri::class;
	protected $allowedFields = ['id', 'sys_page_id', 'uri'];
}