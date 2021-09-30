<?php
/**
 * @var \App\Entities\SysPage $page
 * @var \App\Entities\Imovel[] $imoveis_buscados
 * @var \App\Entities\Imovel[] $imoveis_destaque
 */
?>
<?= partial_view('header') ?>
<?= partial_view('search') ?>

<?= view('App/Home/mais_buscados', [
    'page'    => $page,
    'imoveis' => $imoveis_buscados,
]) ?>
<?= view('App/Home/destaque', [
    'page'    => $page,
    'imoveis' => $imoveis_destaque,
]) ?>
<?= view('App/Home/links', [
    'page'    => $page,
]) ?>

<?= partial_view('footer') ?>