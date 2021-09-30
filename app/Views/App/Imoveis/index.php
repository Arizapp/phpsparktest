<?php
/**
 * @var \App\Entities\SysPage         $page
 * @var \App\Entities\Imovel          $imovel
 * @var \App\Entities\ImovelGallery[] $fotos
 */


echo partial_view('header', compact('page'));
?>
  <style>
      body.imovel {
          background-image: url("<?= $page->variables['banner']  ?>");
      }
  </style>
  <div class="container py-5">
    <h4 class="text-secondary text-center"><?= $page->title ?></h4>
    <h6 class="text-light text-center pb-5"><?= $page->meta_description ?></h6>

    <section class="my-5">
      <!-- Fotos -->
      <div class="fotos border shadow p-2">
        <div class="foto" style="background-image: url('<?= img_uploaded_url($imovel->foto) ?>')">
        </div>
        <div class="galeria row mt-2">
            <?php foreach ($fotos as $foto): ?>
              <div class="col-2">
                <div class="foto-galeria" onclick="Fotos.onClick('<?= img_uploaded_url($foto->image) ?>')"
                     style="background-image: url('<?= img_uploaded_url($foto->image) ?>')"></div>
              </div>
            <?php endforeach; ?>
        </div>
      </div>
      <div class="row my-5 justify-content-around">
        <!-- Info -->
        <div class="col-sm-6">
          <h6 class="text-primary mb-2 titulo" style="vertical-align: middle">
              <?php
              switch ($imovel->tipo) {
                  case 'V':
                      echo 'Casa à venda';
                      break;
                  case 'A':
                      echo 'Casa à para alugar';
                      break;
                  case 'I':
                      echo 'Casa para investimento';
                      break;
              }
              ?>
              <?php if (!empty($imovel->youtube)): ?>
                <a href="<?= $imovel->youtube ?>" target="_blank" class="text-danger link-youtube">
                  <i class="fab fa-youtube"></i>
                </a>
              <?php endif; ?>
          </h6>
          <h6 class="small font-weight-bold"><?= $imovel->bairro ?>, <?= $imovel->cidade->name ?>
            - <?= $imovel->cidade->state->code ?></h6>
          <h5 class="text-primary mt-4">R$ <?= number_format($imovel->valor, '2', ',', '.') ?></h5>
          <div class="row mt-3">
            <div class="col-2 text-center">
              <h5 class="text-primary mb-0"><?= $imovel->quartos ?></h5>
              <small>Quartos</small>
            </div>
            <div class="col-5 text-center">
              <h5 class="text-primary mb-0"><?= $imovel->area_construida ?></h5>
              <small>Área construída (m²)</small>
            </div>
            <div class="col-3 text-center">
              <h5 class="text-primary mb-0"><?= $imovel->area_total ?></h5>
              <small>Área total (m²)</small>
            </div>
            <div class="col-2 text-center">
              <h5 class="text-primary mb-0"><?= $imovel->vagas ?></h5>
              <small>Vagas</small>
            </div>
          </div>
        </div>
        <!-- Contato -->
        <div class="col-sm-6">
          <h6 class="text-primary mb-2 titulo" style="vertical-align: middle">
            Fale com um corretor
          </h6>
          <div class="row mt-3">
            <div class="col-sm-6">
              <img src="<?= img_uploaded_url($page->variables['ico_telefone']->value) ?>" class="float-left">
              <div class="my-2">
                <small>Ligue agora</small><br>
                <span class="text-primary mask-phone"><?= $imovel->telefone ?></span>
              </div>
            </div>
            <div class="col-sm-6">
              <img src="<?= img_uploaded_url($page->variables['ico_whatsapp']->value) ?>" class="float-left">
              <div class="my-2">
                <small>Chame via Whastapp</small><br>
                <span class="text-primary mask-phone"><?= $imovel->whatsapp ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="my-5">
      <div class="row">
        <div class="col-sm-6">
          <h5 class="text-primary mb-4">Mais informações sobre o imóvel</h5>
          <p><?= nl2br($imovel->sobre) ?></p>
        </div>
        <div class="col-sm-6">
          <h5 class="text-primary mb-4">Confira a localização desse imóvel</h5>
          <?= nl2br(
              str_replace('width="600"', 'width="100%"',
                  str_replace('height="450"', 'height="300"', $imovel->mapa))
          ) ?>
        </div>
      </div>
    </section>
  </div>
  <script>
      const Fotos = {
          onClick: function (url) {
              $('.fotos .foto').css('background-image', "url('" + url + "')");
          }
      };
  </script>
<?= partial_view('footer') ?>