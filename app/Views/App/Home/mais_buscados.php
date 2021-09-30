<?php
/**
 * @var \App\Entities\SysPage  $page
 * @var \App\Entities\Imovel[] $imoveis
 */
?>
<div class="container my-5 pt-5">
  <div class="text-center">
    <h2 class="font-weight-normal pt-5">Imóveis Mais Buscados</h2>
    <img src="<?= img_uploaded_url($page->variables['separador']->value) ?>" alt="">
  </div>
  <div class="mt-5">
      <?= view('App/Imoveis/grid', compact('imoveis')) ?>
  </div>
</div>
