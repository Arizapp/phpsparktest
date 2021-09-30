<?php
/**
 * @var \App\Entities\SysPage $page
 */

echo partial_view('header', compact('page'));
?>
  <style>
      body.quem-somos {
          background-image: url("<?= $page->variables['banner']  ?>");
      }
  </style>
  <div class="container py-5">
    <h4 class="text-secondary text-center"><?= $page->title ?></h4>
    <h6 class="text-light text-center pb-5"><?= $page->meta_description ?></h6>
    <section class="pt-5">
      <img src="<?= $page->variables['logo'] ?>" class="float-sm-right ml-sm-4 mb-5 img-fluid" alt=""/>
      <div class="row no-gutters mb-5">
        <div class="col-sm-8">
          <h2 class="text-secondary"><?= $page->variables['titulo'] ?></h2>
        </div>
      </div>
        <?php foreach ($page->variables['textos']->text_pairs as $texto): ?>
          <article class="mb-5">
            <h5 class="text-primary"><?= $texto->title ?></h5>
            <p><?= $texto->text ?></p>
          </article>
        <?php endforeach; ?>
    </section>
  </div>
  </div>
<?= partial_view('footer') ?>