<?php
/**
 * @var \App\Entities\SysPage         $page
 * @var \App\Entities\SysPageTextPair $faq
 */

$faqs = $page->variables['faq']->text_pairs;
$faqs = array_chunk($faqs, count($faqs) / 2);

echo partial_view('header', compact('page'));
?>
  <style>
      body.faq {
          background-image: url("<?= $page->variables['banner']  ?>");
      }
  </style>
  <div class="container py-5">
    <h4 class="text-secondary text-center"><?= $page->title ?></h4>
    <h6 class="text-light text-center pb-5"><?= $page->meta_description ?></h6>
    <div class="row justify-content-center">
      <div class="col-sm-10">
        <div class="accordion mt-5" id="faqs">
          <div class="row">
            <div class="col-sm-6">
                <?php foreach ($faqs[0] as $faq): ?>
                  <div class="item">
                    <div class="titulo pl-0 pt-3 pb-3" id="titulo-<?= $faq->id ?>">
                      <div class="ancora collapsed cursor-pointer"
                           data-toggle="collapse"
                           data-target="#descricao-<?= $faq->id ?>"
                           aria-expanded="false"
                           aria-controls="descricao-<?= $faq->id ?>">
                          <span class="fa-stack text-primary" style="vertical-align: top;">
                            <i class="far fa-circle fa-stack-2x"></i>
                            <i class="fas fa-plus fa-stack-1x"></i>
                          </span>
                          <?= $faq->title ?>
                      </div>
                    </div>
                    <div id="descricao-<?= $faq->id ?>" class="descricao collapse"
                         aria-labelledby="titulo-<?= $faq->id ?>"
                         data-parent="#faqs">
                      <div class="pt-4 pb-5"><?= nl2br($faq->text) ?></div>
                    </div>
                  </div>
                <?php endforeach; ?>
            </div>
            <div class="col-sm-6">
                <?php foreach ($faqs[1] as $faq): ?>
                  <div class="item">
                    <div class="titulo pl-0 pt-3 pb-3" id="titulo-<?= $faq->id ?>">
                      <div class="ancora collapsed cursor-pointer text-dark"
                           data-toggle="collapse"
                           data-target="#descricao-<?= $faq->id ?>"
                           aria-expanded="false"
                           aria-controls="descricao-<?= $faq->id ?>">
                        <span class="fa-stack text-primary" style="vertical-align: top;">
                          <i class="far fa-circle fa-stack-2x"></i>
                          <i class="fas fa-plus fa-stack-1x"></i>
                        </span>
                          <?= $faq->title ?>
                      </div>
                    </div>
                    <div id="descricao-<?= $faq->id ?>" class="descricao collapse"
                         aria-labelledby="titulo-<?= $faq->id ?>"
                         data-parent="#faqs">
                      <div class="pt-4 pb-5"><?= nl2br($faq->text) ?></div>
                    </div>
                  </div>
                <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
      const Faq = {
          init: () => {
              $('#faqs').on('shown.bs.collapse', function () {
                  Faq.swapIcon(this);
              }).on('hidden.bs.collapse', function () {
                  Faq.swapIcon(this);
              });
          },
          swapIcon: obj => {
              const ancoras = $(obj).find('.ancora');
              ancoras.each(index => {
                  const ancora = ancoras[index];
                  const d_ico = $(ancora).find('.fa-stack-1x');
                  if ($(ancora).hasClass('collapsed')) {
                      $(ancora).removeClass('text-primary');
                      $(d_ico).removeClass('fa-minus').addClass('fa-plus');
                  } else {
                      $(ancora).removeClass('text-dark').addClass('text-primary');
                      $(d_ico).removeClass('fa-plus').addClass('fa-minus');
                  }
              });
          }
      };
      $(() => {
          Faq.init();
      });
  </script>
<?= partial_view('footer') ?>