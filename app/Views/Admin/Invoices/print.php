<?php
/**
 * @var array $invoices
 * @var array $products
 * @var array $status
 */
?>
<style>
    body {
        font-family: sans-serif;
    }

    @media print {
        div.pedido {
            page-break-inside: avoid;
        }
    }
</style>
<?php foreach ($invoices as $invoice): ?>
    <div class="pedido">
        <h1>
            <small style="float: right; text-align: right">
                $<?= $invoice['total'] ?>
                <div style="color: gray; font-size: 60%">($<?= $invoice['subtotal'] ?> + $<?= $invoice['delivery_cost'] ?>)</div>
            </small>
            <small style="color: gray">#<?= str_pad($invoice['id'], 4, '0', STR_PAD_LEFT) ?> </small>
			<?= $invoice['sys_customer_id'] ?>
          <small style="color: gray">(<?= $status[$invoice['sys_product_invoice_status_id']] ?>)</small>
        </h1>
        <table style="width: 100%">
            <tbody>
				<?php $categoria = null; ?>
				<?php foreach ($products[ $invoice['id'] ] as $product): ?>
					<?php if ($categoria != $product['sys_product_category_id']): ?>
						<?php $categoria = $product['sys_product_category_id']; ?>
                        <tr>
                            <td colspan="4">
                                <h3 style="margin: 0; padding: 1rem 0; color: #666"><?= $categoria ?></h3>
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align: left">Producto</th>
                            <th style="text-align: center">Unidad</th>
                            <th style="text-align: center">Cuantidad</th>
                            <th style="text-align: right">Valor</th>
                        </tr>
					<?php endif; ?>
                    <tr>
                        <td><?= $product['name'] ?></td>
                        <td style="text-align: center"><?= $product['unit_name'] ?></td>
                        <td style="text-align: center"><?= $product['amount'] ?></td>
                        <td style="text-align: right"><?= bcmul($product['amount'], $product['value'], 2) ?></td>
                    </tr>
				<?php endforeach; ?>
            </tbody>
        </table>
        <div style="background-color: #DFDFDF; border: 1px solid #DDD;  padding: 0.5rem 1rem; margin: 1rem 0">
            <p>
                <strong>Ubicación:</strong>
				<?= $invoice['address'] ?>
            </p>
			<?php if (!empty($invoice['obs'])): ?>
                <p>
                    <strong>Obs:</strong>
					<?= $invoice['obs'] ?>
                </p>
			<?php endif; ?>
        </div>
        <hr style="margin: 1rem 0">
    </div>
<?php endforeach; ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        window.print();
    });
</script>
