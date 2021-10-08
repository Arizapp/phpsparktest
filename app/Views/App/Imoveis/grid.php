<?php

/**
 * @var $imoveis \App\Entities\Imovel[]
 * @var $titulo  string
 */

?>
<div class="container" id="imoveis-grid">
  <div class="row">
    <?php foreach ($imoveis as $imovel) : ?>
      <div class="col-sm-4">
        <div class="imovel card mb-4">
          <a class="picture" href="<?= site_url('imovel/' . $imovel->url) ?>">
            <div class="ver-imovel text-secondary text-center py-2">
              + ver imóvel
            </div>
            <?php if (!empty($imovel->lancamento) && $imovel->lancamento == 1) : ?>
              <div class="lancamento bg-secondary">
                Lançamento
              </div>
            <?php endif; ?>
            <img src="<?= img_uploaded_url($imovel->foto) ?>" class="card-img-top">
          </a>
          <div class="card-body">
            <div class="card-title imoveis-grid">
              <h6 class="text-primary mb-2 titulo" style="vertical-align: middle">
                <?php
                switch ($imovel->tipo) {
                  case 'V':
                    echo 'Casa à venda';
                    break;
                  case 'A':
                    echo 'Casa para alugar';
                    break;
                  case 'I':
                    echo 'Casa para investimento';
                    break;
                }
                ?>
                <?php if (!empty($imovel->youtube)) : ?>
                  <a href="<?= $imovel->youtube ?>" target="_blank" class="text-danger link-youtube">
                    <i class="fab fa-youtube"></i>
                  </a>
                <?php endif; ?>
              </h6>
              <h6 class="imovel-titulo font-weight-bold"><?= $imovel->bairro ?>, <?= $imovel->cidade->name ?>
                - <?= $imovel->cidade->state->code ?></h6>
            </div>
            <div class="card-text">
              <div class="precoView">
                <h5 class="text-primary">R$ <?= number_format($imovel->valor, '2', ',', '.') ?></h5>
                <button class="btn btn-primary">Simular financiamento</button>
              </div>


              <div class="row mt-3">
                <div class="detalhesView">
                  <div class="detalhesViewItem">
                    <h5 class="text-primary mb-0"><?= $imovel->quartos ?></h5>
                    <small class="font-weight-bold">Quartos</small>
                  </div>
                  <div class="detalhesViewItem">
                    <h5 class="text-primary mb-0"><?= $imovel->area_construida ?></h5>
                    <small class="font-weight-bold">Área construida</small>
                  </div>
                  <div class="detalhesViewItem">
                    <h5 class="text-primary mb-0"><?= $imovel->area_total ?></h5>
                    <small class="font-weight-bold">Área total (m²)</small>
                  </div>
                  <div class="detalhesViewItem">
                    <h5 class="text-primary mb-0"><?= $imovel->vagas ?></h5>
                    <small class="font-weight-bold">Vagas</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>