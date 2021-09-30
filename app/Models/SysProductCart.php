<?php

namespace App\Models;

class SysProductCart extends AppModel
{
	public    $table         = 'sys_product_cart';
	protected $returnType    = \App\Entities\SysProductCart::class;
	protected $allowedFields = [
		'id',
		'sys_customer_id',
		'date',
		'subtotal',
		'delivery_cost',
		'total',
	];
}