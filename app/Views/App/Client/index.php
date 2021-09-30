<?php
/**
 * @var \App\Entities\SysPage     $page
 * @var \App\Entities\SysCustomer $customer
 * @var \Exception $error
 */
?>
<?= partial_view('header', ['identifier' => $view]) ?>
    <div class="container h-100 pb-4">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-5">
                <section>
                    <header>
                        <h2 class="text-center text-secondary text-uppercase font-weight-bold my-5"><?= $page->title ?></h2>
                    </header>
					<?php if (isset($error) && $error->getCode() == 1): ?>
                        <div class="alert alert-danger text-center mt-4"><?= $error->getMessage() ?></div>
					<?php endif; ?>
                    <form method="post" action="<?= (string)current_url(true) ?>">
						<?= csrf_field() ?>
                        <input type="hidden" name="action" value="data">
                        <input type="text" id="input-name" name="name"
                               class="form-control  mb-3"
                               value="<?= $customer->name ?>"
                               placeholder="Nombre" required>
                        <textarea id="input-address" name="address"
                                  class="form-control  mb-3"
                                  placeholder="Dirección" rows="3" required><?= $customer->address ?></textarea>
                        <input type="email" id="input-email" name="email"
                               class="form-control  mb-3"
                               value="<?= $customer->email ?>"
                               placeholder="E-mail" required>
                        <input type="password" id="input-current-password" name="current_password"
                               class="form-control  mb-3"
                               placeholder="Contraseña actual" required>
                        <button class="btn btn-primary btn-block" type="submit">CAMBIAR</button>
                    </form>
                </section>
                <section>
                    <header>
                        <h5 class="text-center text-secondary text-uppercase font-weight-bold my-5">Contraseña</h5>
                    </header>
					<?php if (isset($error) && $error->getCode() == 2): ?>
                        <div class="alert alert-danger text-center mt-4"><?= $error->getMessage() ?></div>
					<?php endif; ?>
                    <form method="post" action="<?= (string)current_url(true) ?>">
						<?= csrf_field() ?>
                        <input type="hidden" name="action" value="password">
                        <input type="password" id="input-password" name="password"
                               class="form-control  mb-3"
                               placeholder="Nueva Contraseña" required>
                        <input type="password" id="input-password2" name="password2"
                               class="form-control  mb-3"
                               placeholder="Confirmar Nueva Contraseña" required>
                        <input type="password" id="input-current-password" name="current_password"
                               class="form-control  mb-3"
                               placeholder="Contraseña actual" required>
                        <button class="btn btn-primary btn-block" type="submit">CAMBIAR</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
<?= partial_view('footer') ?>