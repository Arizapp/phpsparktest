<?php

namespace App\Models;

use App\Entities\SysPageTextPair;
use CodeIgniter\Model;

class SysPagesTextPairs extends AppModel
{
	public $table         = 'sys_pages_text_pairs';
	protected $returnType    = SysPageTextPair::class;
	protected $allowedFields = ['id', 'sys_page_variable_id', 'title', 'text', 'order'];
}