<?php

namespace App\Models;

use App\Entities\SysBlogCategory;
use CodeIgniter\Model;

/**
 * Class SysBlogCategories
 * @package App\Models
 */
class SysBlogCategories extends AppModel
{
	public $table         = 'sys_blog_categories';
	protected $returnType    = SysBlogCategory::class;
	protected $allowedFields = [
		'id',
		'name',
	];
}