<?php

namespace App\Models;

use App\Entities\SysProductCartProduct;

class SysProductCartProducts extends AppModel
{
	public    $table         = 'sys_product_cart_products';
	protected $returnType    = SysProductCartProduct::class;
	protected $allowedFields = [
		'id',
		'sys_product_cart_id',
		'sys_product_id',
		'amount',
		'unitary_value',
		'subtotal',
	];
}