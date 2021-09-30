<?php

namespace App\Models;

use App\Entities\SysProductInvoiceProduct;

class SysProductInvoiceProducts extends AppModel
{
	public    $table         = 'sys_product_invoice_products';
	protected $returnType    = SysProductInvoiceProduct::class;
	protected $allowedFields = [
		'id',
		'sys_product_invoice_id',
		'sys_product_id',
		'amount',
		'unitary_value',
		'subtotal',
	];
}