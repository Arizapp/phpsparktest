<?php

namespace App\Models;

use App\Entities\SysProductCategory;

class SysProductCategories extends AppModel
{
	public    $table         = 'sys_product_categories';
	protected $returnType    = SysProductCategory::class;
	protected $allowedFields = [
		'id',
		'name',
	];
}