<?php
/**
 * @var \App\Entities\SysPage $page
 * @var array                 $cart
 */

echo partial_view('header');
?>
<section id="Cart" class="container py-5">
	<?php if (!$cart['count']): ?>
        <header class="text-center">
            <h2 class="text-secondary text-uppercase font-weight-bold mr-sm-4"><?= $page->title ?></h2>
        </header>
        <p class="text-center my-5">El carrito esta vacio.</p>
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <a href="<?= site_url('nuevo-pedido') ?>" class="btn btn-secondary btn-block">
                    <small class="font-weight-bold">NUEVO PEDIDO</small>
                </a>
            </div>
        </div>
	<?php elseif (!$cart['canPurchase']): ?>
        <header class="text-center">
            <h2 class="text-secondary text-uppercase font-weight-bold mr-sm-4"><?= $page->title ?></h2>
        </header>
        <p class="text-center my-5">EL PRECIO MÍNIMO DE COMPRA ES
            <strong>$<?= number_format((double)sys_config()->variables['compra_minima_valor']->value, 0) ?></strong></p>
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <a href="<?= site_url('nuevo-pedido') ?>" class="btn btn-secondary btn-block">
                    <small class="font-weight-bold">VER PEDIDO</small>
                </a>
            </div>
        </div>
	<?php else: ?>
        <header class="d-flex flex-column flex-sm-row align-items-center">
            <h2 class="text-secondary text-uppercase font-weight-bold mr-sm-4"><?= $page->title ?></h2>
            <h2 class="text-uppercase font-weight-bold ml-sm-auto">
                $<?= number_format((double)$cart['value'], 2, ',', '.') ?><sup>*</sup>
            </h2>
        </header>
        <form action="<?= site_url('caja') ?>" method="post">
			<?= csrf_field() ?>
            <div class="row font-weight-bold text-gray d-none d-sm-flex py-3">
                <div class="col-sm-4">
                    Producto
                </div>
                <div class="col-sm-2">
                    Unidad
                </div>
                <div class="col-sm-2">
                    Valor
                </div>
                <div class="col-sm-2">
                    Cantidad
                </div>
                <div class="col-sm-2 text-sm-right">
                    Valor Total
                </div>
            </div>
			<?php foreach ($cart['products'] as $product): ?>
                <div class="row align-items-center py-3 py-sm-1">
                    <div class="col-8 col-sm-4 text-uppercase"><?= $product['name'] ?></div>
                    <div class="col-3 col-sm-2 text-right text-sm-left text-nowrap">
                        <span class="d-inline d-sm-none">$<?= number_format((double)$product['value'], 2, ',', '.') ?>
                            / </span>
						<?= $product['unit_name'] ?>
                    </div>
                    <div class="d-none d-sm-block col-sm-2">
						<?= $product['unit_name'] ?>
                    </div>
                    <div class="col-8 col-sm-2">
						<?= $product['inCart'] ?>
                    </div>
                    <div class="col-4 col-sm-2 text-right">
                        $<?= number_format((double)$product['value'], 2, ',', '.') ?>
                    </div>
                </div>
			<?php endforeach; ?>
            <footer class="my-5">
                <div class="row justify-content-center">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="input-address" class="text-gray">
                                <small>DIRECCIÓN:</small>
                            </label>
                            <textarea name="address" rows="3" class="form-control"
                                      id="input-address"><?= (new \App\Libraries\Customer\Auth())->user()->address ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="input-obs" class="text-gray">
                                <small>OBSERVACIÓN:</small>
                            </label>
                            <textarea name="obs" rows="3" class="form-control" id="input-obs"></textarea>
                        </div>
                    </div>
                </div>
                <small class="d-block my-3 text-center">
                    * ENTREGA A DOMICILIO
                    <strong>$<?= number_format((double)sys_config()->variables['entrega_valor']->value, 0) ?></strong>
                </small>
                <div class="row justify-content-center">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-secondary btn-block">
                            <small class="font-weight-bold">CONFIRMAR</small>
                        </button>
                    </div>
                </div>
                <div class="text-center my-3">
                    <a href="<?= site_url('nuevo-pedido') ?>"
                       onclick="return window.confirm('¿Estas seguro que quieres cancelar?')">
                        <small class="text-danger font-weight-bold cursor-pointer">CANCELAR</small>
                    </a>
                </div>
            </footer>
        </form>
	<?php endif; ?>
</section>
<?= partial_view('footer') ?>
