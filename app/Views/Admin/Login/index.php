<?= view('Admin/Login/header', ['identifier' => $view]) ?>
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-5">
                <a class="d-block text-center my-3 my-sm-5" href="/">
					<?php img('LogoWhite.svg', '', 'Minuto Advogado', 'max-width: 60%') ?>
                </a>
                <div class="form-box bg-white p-4 shadow">
                    <form method="post" action="<?= (string)current_url(true) ?>">
						<?= csrf_field() ?>
                        <h5 class="mb-4 text-primary text-center">Painel Administrativo</h5>
                        <div class="input-icon-email">
                            <input type="email" id="input-email" name="email"
                                   class="form-control form-control-lg mb-3"
                                   placeholder="E-mail" required autofocus>
                        </div>
                        <div class="input-icon-password">
                            <input type="password" id="input-password" name="password"
                                   class="form-control form-control-lg mb-3"
                                   placeholder="Senha" required>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
						<?php if (isset($error)): d($error);?>
                            <div class="alert alert-danger text-center mt-4"><?= $error->getMessage() ?></div>
						<?php endif; ?>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?= view('Admin/Login/footer') ?>