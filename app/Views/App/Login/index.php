<?php
/**
 * @var \App\Entities\SysPage $page
 */
?>
<?= view('App/Login/header', ['identifier' => $view]) ?>
<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-md-6">
            <a href="<?= site_url() ?>" class="d-block text-center my-4 my-md-5">
                <img src="<?= $page->variables['logo'] ?>" alt="" class="img-fluid">
            </a>
        </div>
        <div class="w-100"></div>
        <div class="col-md-4">
            <h2 class="text-center text-secondary text-uppercase font-weight-bold my-4"><?= $page->title ?></h2>
            <form method="post" action="<?= (string)current_url(true) ?>">
				<?= csrf_field() ?>
                <input type="email" id="input-email" name="email"
                       class="form-control form-control-lg mb-3"
                       placeholder="E-mail" required>
                <input type="password" id="input-password" name="password"
                       class="form-control form-control-lg mb-3"
                       placeholder="Contraseña" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">ENTRAR</button>
				<?php if (isset($error)): ?>
                    <div class="alert alert-danger text-center mt-4"><?= $error->getMessage() ?></div>
				<?php endif; ?>
                <p class="text-center my-3 pb-4 pb-md-5">
                    <a href="<?= site_url('olvide-mi-contrasena') ?>" class="text-primary text-decoration-underline">Olvidé
                        mi contraseña</a>
                </p>
                <a href="<?= site_url('crear-cuenta') ?>" class="btn btn-lg btn-secondary btn-block text-white my-md-5">
                    CREAR CUENTA
                </a>
            </form>

        </div>
    </div>
</div>