<?php namespace App\Controllers\App;

use App\Entities\SysConfig;
use App\Entities\SysProduct;
use App\Entities\SysProductInvoiceStatus;
use App\Models\SysPages;
use App\Models\SysProductInvoice;
use App\Models\SysProductInvoiceProducts;
use App\Models\SysProductInvoiceStatusHistory;
use App\Models\SysProducts;
use Exception;

class Checkout extends AppController
{
	public function index()
	{
		$data = [];
		try
		{
			$page = (new SysPages())->find(uri_string());
			$data[] = 'page';

			$post = $this->request->getPost();
			if (empty($post)) return redirect()->to(site_url('carrito'));

			$user = $this->auth->user();

			$cart = (new \App\Libraries\Builder\Cart());
			$checkout = $cart->checkout();

			/* Fix amounts */
			$subtotal = 0;
			$amountAlert = [];
			$data[] = 'amountAlert';
			$SysProducts = new SysProducts();
			foreach ($checkout['products'] as $key => $product)
			{
				/** @var SysProduct $SysProduct */
				$SysProduct = $SysProducts->find($product['id']);
				if ($SysProduct->amount < $product['inCart'])
				{
					$alert = [
						'product' => $SysProduct->name,
						'before'  => $product['inCart'],
						'after'   => 0,
					];
					if ($SysProduct->amount == 0)
					{
						$amountAlert[] = $alert;
						unset($checkout['products'][ $key ]);
						continue;
					};
					$checkout['products'][$key]['inCart'] = $SysProduct->amount;
					$checkout['products'][$key]['valueCart'] = (double)bcmul($product['inCart'], $product['value'], 2);
					$alert['after'] = $product['inCart'];
					$amountAlert[] = $alert;
				}
				$subtotal = bcadd($subtotal, $product['valueCart']);
			}

			/* Create invoice */
			$delivery_cost = (double)(SysConfig::getSharedInstance())->variables['entrega_valor']->value;
			$total = bcadd($delivery_cost, $subtotal);
			$minimo = (SysConfig::getSharedInstance())->variables['compra_minima_valor']->value;
			if ($total < $minimo)
			{
				throw new Exception("No fue posible realizar la compra porque el costo total (\${$total}) es menor que el costo mínimo (\${$minimo}).");
			}

			$invoice = [
				'sys_customer_id'               => $user->id,
				'sys_product_invoice_status_id' => SysProductInvoiceStatus::WAITING,
				'date'                          => date('Y-m-d H:i:s'),
				'subtotal'                      => $subtotal,
				'delivery_cost'                 => $delivery_cost,
				'total'                         => $total,
				'obs'                           => $post['obs'],
				'address'                       => !empty($post['address']) ? $post['address'] : $user->address,
			];
			$invoice['id'] = (new SysProductInvoice())->insert($invoice);
			if (!$invoice['id']) throw new Exception('No se puede ingresar a la compra!');

			/* Add products to invoice */
			foreach ($checkout['products'] as $product)
			{
				$pi = [
					'sys_product_invoice_id' => $invoice['id'],
					'sys_product_id'         => $product['id'],
					'amount'                 => $product['inCart'],
					'unitary_value'          => $product['value'],
					'subtotal'               => $product['valueCart'],
				];

				(new SysProductInvoiceProducts())->insert($pi);

				$SysProduct = $SysProducts->find($product['id']);
				$amount = $SysProduct->amount - $product['inCart'];
				$SysProduct->amount = $amount > 0 ? $amount : 0;
				$SysProducts->save($SysProduct);
			}

			/* Add invoice status history */
			(new SysProductInvoiceStatusHistory())->insert([
				'sys_product_invoice_id'        => $invoice['id'],
				'sys_product_invoice_status_id' => SysProductInvoiceStatus::WAITING,
				'date'                          => date('Y-m-d H:i:s'),
			]);

			/* Clear cart */
			$cart->clear();

		} catch (Exception $ex)
		{
			$error = $ex->getMessage();
			$data[] = 'error';
		}

		return view('App/Checkout/index', compact($data));
	}

}
