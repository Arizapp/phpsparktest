<?php
$identifier = $identifier ?? null;
?>
<nav id="main-nav" class="navbar navbar-expand-lg navbar-light bg-light py-0">
  <a class="navbar-brand" href="<?= site_url("/") ?>">
    <img class="my-3 ml-3" src="<?= sys_config()->variables['logo'] ?>" alt="<?= sys_config()->title ?>">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="navbarNav"
          aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="main-menu">
    <ul class="navbar-nav">
      <li class="nav-item <?= $identifier == 'quem-somos' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('quem-somos') ?>">Quem Somos</a>
      </li>
      <li class="nav-item dropdown  <?= $identifier == 'imoveis' ? 'active' : '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
          Imóveis
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= site_url('comprar') ?>">Comprar</a>
          <a class="dropdown-item" href="<?= site_url('alugar') ?>">Alugar</a>
          <a class="dropdown-item" href="<?= site_url('investir') ?>">Investir</a>
        </div>
      </li>
      <li class="nav-item <?= $identifier == 'indique-um-amigo' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('indique-um-amigo') ?>">Indique um amigo</a>
      </li>
      <li class="nav-item  <?= $identifier == 'trabalhe-conosco' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('trabalhe-conosco') ?>">Trabalhe conosco</a>
      </li>
      <li class="nav-item <?= $identifier == 'faq' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('faq') ?>">FAQ</a>
      </li>
<!--      <li class="nav-item --><?//= $identifier == 'blog' ? 'active' : '' ?><!--">-->
<!--        <a class="nav-link" href="--><?//= site_url('blog') ?><!--">Blog</a>-->
<!--      </li>-->
      <li class="nav-item <?= $identifier == 'contato' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('contato') ?>">Contato</a>
      </li>
<!--      <li class="nav-item d-flex align-items-center">-->
<!--        <a class="btn btn-secondary rounded-pill" href="#">Simulador de Financiamento</a>-->
<!--      </li>-->
    </ul>
  </div>
</nav>