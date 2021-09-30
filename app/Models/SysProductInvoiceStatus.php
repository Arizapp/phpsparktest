<?php

namespace App\Models;

class SysProductInvoiceStatus extends AppModel
{
	public    $table         = 'sys_product_invoice_status';
	protected $returnType    = \App\Entities\SysProductInvoiceStatus::class;
	protected $allowedFields = [
		'id',
		'name',
	];
}