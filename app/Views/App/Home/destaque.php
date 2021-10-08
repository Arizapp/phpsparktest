<?php
/**
 * @var \App\Entities\SysPage  $page
 * @var \App\Entities\Imovel[] $imoveis
 */
?>
<div class="container my-5">
  <div class="text-center">
    <h2 class="font-weight-normal">Vídeos do imóveis em Destaques</h2>
    <img src="<?= img_uploaded_url($page->variables['separador']->value) ?>" alt="">
  </div>
  <div class="mt-5">
    <div class="row">
        <?php foreach ($imoveis as $imovel): ?>
          <div class="col-sm-3 card-video-area">
            <a target="_blank" href="<?=  $imovel->youtube ?>"
                class="d-block" style="
                background-image: url('<?= img_uploaded_url($imovel->foto) ?>');
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;
                ">
              <div class="py-5 px-3 card-video-item" style="background: rgba(0,0,0,0.5);">
                <img src="<?= img_uploaded_url($page->variables['ico_youtube']->value) ?>" alt="">
                <div class="text-white my-4"><?= $imovel->cidade->name ?></div>
                <h5 class="text-secondary my-4 font-weight-normal">
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
                    ?> no Setor <?= $imovel->bairro ?>
                </h5>
                <small class="text-white"><?= substr(strip_tags(nl2br($imovel->sobre)),0,200); ?></small>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
    </div>
  </div>
</div>
