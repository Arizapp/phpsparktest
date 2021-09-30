<?php

namespace App\Models;

class SysProductInvoiceStatusHistory extends AppModel
{
	public    $table         = 'sys_product_invoice_status_history';
	protected $returnType    = \App\Entities\SysProductInvoiceStatusHistory::class;
	protected $allowedFields = [
		'id',
		'sys_product_invoice_id',
		'sys_product_invoice_status_id',
		'date',
	];
}