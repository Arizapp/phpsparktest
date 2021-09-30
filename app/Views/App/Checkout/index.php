<?php

/**
 * @var \App\Entities\SysPage $page
 * @var array                 $amountAlert
 */

echo partial_view('header');
?>
    <section id="Caja" class="container py-5">
        <header class="text-center">
            <h2 class="text-secondary text-uppercase font-weight-bold mr-sm-4"><?= $page->title ?></h2>
        </header>
        <p class="text-center font-weight-bold my-5"><?= empty($error) ? '¡Éxito al realizar el pedido!' : $error ?></p>
		<?php if (!empty($amountAlert)): ?>
            <div class="row justify-content-center my-5">
                <div class="col-sm-9">
                    <div class="text-center">
                        <h5 class="text-secondary">¡Atención!</h5>
                        <p>Algunos productos han sido retirados o han cambiado sus cantidades debido a un cambio en el
                            stock.</p>
                    </div>
                    <table class="table border">
						<?php foreach ($amountAlert as $alert): ?>
                            <tr>
                                <th><?= $alert["product"] ?></th>
                                <td class="text-center"><?= $alert["before"] ?></td>
                                <td width="1"><i class="fas fa-arrow-right"></i></td>
                                <td class="text-center"><?= $alert["after"] ? $alert["after"] : 'retirado' ?></td>
                            </tr>
						<?php endforeach; ?>
                    </table>
                </div>
            </div>
		<?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-sm-4">
				<?php if (empty($error)): ?>
                    <a href="<?= site_url('mis-pedidos') ?>" class="btn btn-secondary btn-block">
                        <small class="font-weight-bold">MIS PEDIDOS</small>
                    </a>
				<?php else: ?>
                    <a href="<?= site_url('nuevo-pedido') ?>" class="btn btn-secondary btn-block">
                        <small class="font-weight-bold">NUEVO PEDIDO</small>
                    </a>
				<?php endif; ?>
            </div>
        </div>
    </section>
<?= partial_view('footer') ?>