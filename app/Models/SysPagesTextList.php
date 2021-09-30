<?php

namespace App\Models;

use App\Entities\SysPageTextItem;
use CodeIgniter\Model;

class SysPagesTextList extends AppModel
{
	public $table         = 'sys_pages_text_list';
	protected $returnType    = SysPageTextItem::class;
	protected $allowedFields = ['id', 'sys_page_variable_id', 'text', 'order'];
}