<?php

namespace App\Models;

class SysProductInvoice extends AppModel
{
	public    $table         = 'sys_product_invoice';
	protected $returnType    = \App\Entities\SysProductInvoice::class;
	protected $allowedFields = [
		'id',
		'sys_customer_id',
		'sys_product_invoice_status_id',
		'date',
		'subtotal',
		'delivery_cost',
		'total',
		'obs',
		'address',
	];
}