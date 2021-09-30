</main>
<footer id="main-footer" class="footer mt-auto">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <h1 class="text-primary text-center mb-3">VAMOS CONVERSAR</h1>
        <a href="<?= site_url('contato') ?>" class="btn btn-secondary rounded-pill btn-block btn-lg py-3">
          Ligamos para você
        </a>
      </div>
    </div>
  </div>
  <div class="my-5">
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link text-dark" href="<?= site_url() ?>">Best Imob</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link text-dark dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
           aria-expanded="false">Imóveis</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?= site_url('comprar') ?>">Comprar</a>
          <a class="dropdown-item" href="<?= site_url('alugar') ?>">Alugar</a>
          <a class="dropdown-item" href="<?= site_url('investir') ?>">Investir</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="<?= site_url('faq') ?>">FAQ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="<?= site_url('trabalhe-conosco') ?>">Trabalhe conosco</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="<?= site_url('indique-um-amigo') ?>">Indique um amigo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="<?= site_url('contato') ?>">Contato</a>
      </li>
    </ul>
  </div>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-sm-3">
        <h4>
          <img src="<?= img_uploaded_url(sys_config()->variables['ico_whatsapp']->value) ?>">
            <?= sys_config()->variables['whatsapp']->value ?>
        </h4>
      </div>
      <div class="col-sm-3">
        <h4>
          <img src="<?= img_uploaded_url(sys_config()->variables['ico_telefone']->value) ?>">
            <?= sys_config()->variables['telefone']->value ?>
        </h4>
      </div>
    </div>
  </div>
  <div class="py-3 bg-primary text-white">
    <div class="container text-center">
      <div class="row align-items-center">
        <div class="col-sm-6">
          <small>2020 © <?= sys_config()->title ?> - Todos os direitos reservados.</small>
        </div>
        <div class="col-sm-6 text-sm-right">
          <small class="mr-2 d-inline-block">Desenvolvido por:</small>
          <img src="<?= img_uploaded_url(sys_config()->variables['logo_ligados']->value) ?>">
      </div>
      </div>
    </div>
  </div>
</footer>
</section>
</body>
</html>