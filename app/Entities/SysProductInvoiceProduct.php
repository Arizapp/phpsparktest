<?php

namespace App\Entities;

use App\Models\SysProducts;

/**
 * Class SysProductInvoiceProduct
 * @package App\Entities
 *
 * @property int               $id
 * @property int               $sys_product_invoice_id
 * @property int               $sys_product_id
 * @property int               $amount
 * @property double            $unitary_value
 * @property double            $subtotal
 * @property SysProductInvoice $invoice
 * @property SysProduct        $product
 */
class SysProductInvoiceProduct extends AppEntity
{
	public function getInvoice()
	{
		return $this->fetchProperty(
			'invoice',
			'sys_product_invoice_id',
			\App\Models\SysProductInvoice::class,
			SysProductInvoice::class
		);
	}

	public function getProduct()
	{
		return $this->fetchProperty(
			'product',
			'sys_product_id',
			SysProducts::class,
			SysProduct::class
		);
	}

}