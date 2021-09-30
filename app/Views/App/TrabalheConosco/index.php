<?php
/**
 * @var \App\Entities\SysPage $page
 */

echo partial_view('header', compact('page'));

$cores = $page->variables['cores']->text_pairs_as_variables;

?>
<?php vendor_js('vue/vue'); ?>
<?php vendor_js('vue-the-mask/vue-the-mask'); ?>
<?php vendor_js('sweetalert2/sweetalert2.all'); ?>
  <style>
      body.trabalhe-conosco {
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
          <div class="row">
            <div class="col col-sm-8">
              <h3 class="text-secondary mb-4"><?= $page->variables['titulo'] ?></h3>
              <div><?= $page->variables['descricao'] ?></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <form action="https://vuejs.org/" method="post" @submit="checkForm" id="TrabalheForm">
            <div class="form-row">
              <div class="form-group col-sm-6">
                <input type="text" class="form-control"
                       :class="{'is-invalid' : errors.nome}"
                       v-model="form.nome"
                       placeholder="*Seu nome">
              </div>
              <div class="form-group col-sm-6">
                <input type="text" class="form-control"
                       :class="{'is-invalid' : errors.cpf}"
                       v-mask="'###.###.###-##'"
                       v-model="form.cpf"
                       placeholder="*CPF">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <input type="text" class="form-control"
                       :class="{'is-invalid' : errors.telefone}"
                       v-mask="['(##) ####-####', '(##) #####-####']"
                       v-model="form.telefone"
                       placeholder="*Seu Telefone">
              </div>
              <div class="form-group col-sm-6">
                <input type="text" class="form-control"
                       :class="{'is-invalid' : errors.whatsapp}"
                       v-mask="['(##) ####-####', '(##) #####-####']"
                       v-model="form.whatsapp"
                       placeholder="*Seu Whatsapp">
              </div>
            </div>
            <div class="form-group">
              <div class="form-group">
                <input type="text" class="form-control"
                       :class="{'is-invalid' : errors.creci}"
                       v-model="form.creci" placeholder="*Número do CRECI">
              </div>
              <input type="tel" class="form-control"
                     :class="{'is-invalid' : errors.cidade}"
                     v-model="form.cidade" placeholder="*Cidade de Atuação">
            </div>
            <div class="form-group">
              <input type="text" class="form-control"
                     :class="{'is-invalid' : errors.email}"
                     v-model="form.email"
                     placeholder="*E-mail">
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <input type="text" class="form-control"
                       :class="{'is-invalid' : errors.senha}"
                       v-model="form.senha"
                       placeholder="*Crie uma senha">
              </div>
              <div class="form-group col-sm-6">
                <input type="text" class="form-control"
                       :class="{'is-invalid' : errors.senha2}"
                       v-model="form.senha2"
                       placeholder="*Confirme sua senha">
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
              Enviar indicação
            </button>
          </form>
        </div>
      </div>
    </section>
  </div>
  <img src="<?= img_uploaded_url($page->variables['banner2']->value) ?>" class="img-fluid">
  <div class="container my-3">
      <?php foreach ($page->variables['faixas']->gallery as $key => $item): ?>
        <div class="row no-gutters">
          <div class="col-sm-6">
            <img src="<?= $item->image ?>" class="img-fluid">
          </div>
          <div class="col-sm-6 p-3 <?= ($key % 2) == 0 ? 'order-last' : 'order-first'; ?>"
               style="background: <?= $cores[$item->title] ?>">
            <h3 class="<?= $item->title == 'Faixa Branca' ? 'text-gray' : 'text-white' ?>">
                <?= $item->title ?>
            </h3>
            <p class="small <?= $item->title == 'Faixa Branca' ? 'text-gray' : 'text-white' ?>">
                <?= nl2br($item->description) ?>
            </p>
            <a href="<?= $item->url ?>" target="<?= $item->url_external ? '_blank':'' ?>"
            class="btn btn-sm rounded-pill <?= $item->title == 'Faixa Branca' ? 'btn-gray' : 'btn-white' ?>">
              Cadastre-se agora!
            </a>
          </div>
        </div>
      <?php endforeach; ?>
  </div>
  <script><?= view('App/TrabalheConosco/index.js.php') ?></script>
<?= partial_view('footer') ?>