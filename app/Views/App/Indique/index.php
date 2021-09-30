<?php
/**
 * @var \App\Entities\SysPage $page
 */

echo partial_view('header', compact('page'));

?>
<?php vendor_js('vue/vue'); ?>
<?php vendor_js('vue-the-mask/vue-the-mask'); ?>
<?php vendor_js('sweetalert2/sweetalert2.all'); ?>
  <style>
      body.indique-um-amigo {
          background-image: url("<?= $page->variables['banner']  ?>");
      }
  </style>
  <div class="container py-5">
    <h4 class="text-secondary text-center"><?= $page->title ?></h4>
    <h6 class="text-light text-center pb-5"><?= $page->meta_description ?></h6>
    <section class="pt-5">
      <div class="row">
        <div class="col-sm-6">
          <!-- Titulos -->
          <div class="row mb-4">
            <div class="col col-sm-8 font-italic">
              <h3 class="text-secondary"><?= $page->variables['titulo'] ?></h3>
              <h3 class="text-primary"><?= $page->variables['subtitulo'] ?></h3>
            </div>
          </div>
          <!-- Passos -->
          <div class="row">
              <?php foreach ($page->variables['passos']->gallery as $passo): ?>
                <div class="col-sm-4 text-center">
                  <img src="<?= $passo->image ?>" class="mb-3">
                  <p class="small font-weight-bold"><?= $passo->title ?></p>
                </div>
              <?php endforeach; ?>
          </div>
        </div>
        <div class="col-sm-6">
          <form action="https://vuejs.org/" method="post" @submit="checkForm" id="IndiqueForm">
            <div class="form-group">
              <input type="text" class="form-control"
                     :class="{'is-invalid' : errors.seu_nome}"
                     v-model="form.seu_nome"
                     placeholder="*Seu nome">
            </div>
            <div class="form-group">
              <div class="form-group">
                <input type="text" class="form-control"
                       :class="{'is-invalid' : errors.seu_contato}"
                       v-model="form.seu_contato" placeholder="*Seu contato">
              </div>
              <input type="tel" class="form-control"
                     :class="{'is-invalid' : errors.amigo_nome}"
                     v-model="form.amigo_nome" placeholder="*Nome do seu amigo">
            </div>
            <div class="form-group">
              <input type="text" class="form-control"
                     :class="{'is-invalid' : errors.amigo_contato}"
                     v-model="form.amigo_contato"
                     placeholder="*Contato do seu amigo">
            </div>
            <div class="form-group">
            <textarea class="form-control"
                      :class="{'is-invalid' : errors.mensagem}"
                      rows="4" v-model="form.mensagem"
                      placeholder="*Mensagem"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
              Enviar indicação
            </button>
          </form>
        </div>
      </div>
      <div class="my-5">
        <h1 class="text-center text-secondary font-italic d-block mb-4">Entenda Melhor!</h1>
        <p class="text-justify"><?= $page->variables['entenda'] ?></p>
      </div>
    </section>
  </div>
  <script><?= view('App/Indique/index.js.php') ?></script>
<?= partial_view('footer') ?>