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
    <h4 class="text-secondary text-center"><?= $page->title ?></h4>
    <h6 class="text-light text-center pb-5"><?= $page->meta_description ?></h6>
    <div class="row justify-content-center">
      <div class="col-sm-10">
        Idade
      </div>
    </div>
  </div>
<?= partial_view('footer') ?>