<?php

/**
 * @var \App\Entities\SysPage  $page
 * @var \App\Entities\Imovel[] $imoveis
 */


echo partial_view('header', compact('page'));
echo partial_view('search', compact('page'));
?>
<div class="container py-5">
  <h4 class="text-secondary text-center mt-5"><?= $page->title ?></h4>
  <h6 class="text-light text-center pb-5"><?= $page->meta_description ?></h6>
  <?= view('App/Imoveis/grid', ['imoveis' => $imoveis, 'titulo' => 'Casa para investir']) ?>
</div>
<?= partial_view('footer') ?>