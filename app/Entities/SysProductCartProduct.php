<?php

namespace App\Entities;

use App\Models\SysProducts;

/**
 * Class SysProductCartProduct
 * @package App\Entities
 *
 * @property int            $id
 * @property int            $sys_product_cart_id
 * @property int            $sys_product_id
 * @property int            $amount
 * @property double         $unitary_value
 * @property double         $subtotal
 * @property SysProductCart $cart
 * @property SysProduct     $product
 */
class SysProductCartProduct extends AppEntity
{
	public function getCart()
	{
		return $this->fetchProperty(
			'cart',
			'sys_product_cart_id',
			\App\Models\SysProductCart::class,
			SysProductCart::class
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