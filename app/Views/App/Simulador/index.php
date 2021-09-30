<?php
/**
 * @var \App\Entities\SysPage         $page
 * @var \App\Entities\SysPageTextPair $faq
 */

//$faqs = $page->variables['faq']->text_pairs;
//$faqs = array_chunk($faqs, count($faqs) / 2);

echo partial_view('header', compact('page'));
?>
  <style>
      body.simulador {
          background-image: url("<?= $page->variables['banner']  ?>");
      }
  </style>
  <div class="container py-5">
    <div class="row">
      <div class="col-sm-5">
        <h2 class="text-primary pb-4"><?= $page->meta_description ?></h2>
        <h6 class="text-dark pb-4"><?= $page->variables['subtitulo'] ?></h6>
        <div class="row pb-4">
          <div class="col-sm-4 pb-3">
            <a href="" class="btn btn-secondary btn-block font-weight-bold px-2 py-2">
              R$ 150 mil
            </a>
          </div>
          <div class="col-sm-4 pb-3">
            <a href="" class="btn btn-secondary btn-block font-weight-bold px-2 py-2">
              R$ 250 mil
            </a>
          </div>
          <div class="col-sm-4 pb-3">
            <a href="" class="btn btn-secondary btn-block font-weight-bold px-2 py-2">
              R$ 350 mil
            </a>
          </div>
          <div class="col-sm-4 pb-3">
            <a href="" class="btn btn-secondary btn-block font-weight-bold px-2 py-2">
              R$ 450 mil
            </a>
          </div>
          <div class="col-sm-4 pb-3">
            <a href="" class="btn btn-secondary btn-block font-weight-bold px-2 py-2">
              R$ 550 mil
            </a>
          </div>
          <div class="col-sm-4 pb-3">
            <a href="" class="btn btn-secondary btn-block font-weight-bold px-1 py-2">
              Outro Valor
            </a>
          </div>
        </div>
        <a href="" class="font-weight-bold"><i class="fas fa-angle-left"></i> Voltar</a>
      </div>
    </div>
<?= partial_view('footer') ?>