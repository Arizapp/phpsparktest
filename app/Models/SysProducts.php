<?php

namespace App\Models;

use App\Entities\SysProduct;

class SysProducts extends AppModel
{
	public    $table         = 'sys_products';
	protected $returnType    = SysProduct::class;
	protected $allowedFields = [
		'id',
		'sys_product_category_id',
		'picture',
		'name',
		'unit_name',
		'value',
		'amount',
	];
}