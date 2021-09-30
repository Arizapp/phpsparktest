<?php

namespace App\Libraries\Builder;

use App\Entities\SysConfig;
use App\Models\SysProducts;
use CodeIgniter\Config\Services;

class Cart
{
	protected $session_name = 'cart';
	private   $session;

	public function __construct()
	{
		$this->session = Services::session();
	}

	public function get()
	{
		$cart = $this->session->get($this->session_name);

		if (empty($cart))
		{
			$products = (new SysProducts())
				->where('amount >', 0)
				->orderBy('sys_product_category_id')
				->orderBy('name')
				->asArray()
				->findAll();
			$this->updateProducs($products);

			$cart = [
				'products'    => $products,
				'value'       => (double)(SysConfig::getSharedInstance())->variables['entrega_valor']->value,
				'count'       => 0,
				'canPurchase' => false,
			];

			$this->set($cart);
		}

		return $cart;
	}

	public function checkout()
	{
		$cart = $this->get();

		foreach ($cart['products'] as $key => $product)
		{
			if ($product['inCart'] == 0) unset($cart['products'][ $key ]);
		}

		usort($cart['products'], function($p1, $p2) {
			return $p1['name'] > $p2['name'];
		});

		return $cart;
	}

	public function invoice()
	{
		$cart = $this->checkout();

	}

	public function add($id)
	{
		$cart = $this->get();
		foreach ($cart['products'] as &$product)
		{
			if ($product['id'] == $id)
			{
				$product['inCart']++;
				break;
			}
		}
		$this->updateProducs($cart['products']);
		$this->updateCart($cart);
		$this->set($cart);
	}

	public function del($id)
	{
		$cart = $this->get();
		foreach ($cart['products'] as &$product)
		{
			if ($product['id'] == $id)
			{
				$product['inCart']--;
				break;
			}
		}
		$this->updateProducs($cart['products']);
		$this->updateCart($cart);
		$this->set($cart);
	}

	public function updateCart(&$cart)
	{
		$count = 0;
		$value = (double)(SysConfig::getSharedInstance())->variables['entrega_valor']->value;
		foreach ($cart['products'] as $product)
		{
			if ($product['inCart'] > 0)
			{
				$count++;
			}
			$value = bcadd($value, $product['valueCart'], 2);
		}
		$cart['count'] = $count;
		$cart['value'] = $value;
		$cart['canPurchase'] = (double)$value >= (double)(SysConfig::getSharedInstance())->variables['compra_minima_valor']->value;
	}

	public function updateProducs(&$products)
	{
		$products = array_map(function ($product)
		{
			$product['id'] = (int)$product['id'];
			$product['amount'] = (int)$product['amount'];
			$product['value'] = (double)$product['value'];
			$product['inCart'] = isset($product['inCart']) ? $product['inCart'] : 0;
			$product['inCart'] = $product['inCart'] > $product['amount'] ? $product['amount'] : $product['inCart'];
			$product['inCart'] = $product['inCart'] < 0 ? 0 : $product['inCart'];
			$product['valueCart'] = (double)bcmul($product['inCart'], $product['value'], 2);
			$product['showPic'] = false;

			return $product;
		}, $products);
	}

	public function set($cart)
	{
		$this->session->set($this->session_name, $cart);
	}

	public function clear()
	{
		$this->session->remove($this->session_name);
	}

}