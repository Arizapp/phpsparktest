<?php
/**
 * @var \App\Entities\SysPage $page
 */

$formulario = $page->variables['formulario']->text_pairs_as_variables;

?>
  <style>
      body.contato {
          background-image: url("<?= $page->variables['banner']  ?>");
      }
  </style>

<?= partial_view('header') ?>
<?php vendor_js('vue/vue'); ?>
<?php vendor_js('vue-the-mask/vue-the-mask'); ?>
<?php vendor_js('sweetalert2/sweetalert2.all'); ?>
  <div class="container py-5">
    <h6 class="text-light text-center my-3"><?php echo $page->meta_description ?></h6>
    <section class="formulario row justify-content-center">
      <div class="col-sm-10">
        <form action="https://vuejs.org/" method="post" @submit="checkForm" id="ContatoForm">
          <div class="form-row">
            <div class="form-group col-sm-6">
              <input type="text" class="form-control"
                     :class="{'is-invalid' : errors.nome}"
                     v-model="form.nome"
                     placeholder="<?= $formulario['nome'] ?>">
            </div>
            <div class="form-group col-sm-6">
              <input type="email" class="form-control"
                     :class="{'is-invalid' : errors.email}"
                     v-model="form.email" placeholder="<?= $formulario['email'] ?>">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-sm-6">
              <input type="tel" class="form-control"
                     :class="{'is-invalid' : errors.telefone}"
                     v-mask="['(##) ####-####', '(##) #####-####']"
                     v-model="form.telefone" placeholder="<?= $formulario['telefone'] ?>">
            </div>
            <div class="form-group col-sm-6">
              <input type="text" class="form-control"
                     :class="{'is-invalid' : errors.assunto}"
                     v-model="form.assunto"
                     placeholder="<?= $formulario['assunto'] ?>">
            </div>
          </div>
          <div class="form-group">
            <textarea class="form-control"
                      :class="{'is-invalid' : errors.mensagem}"
                      rows="4" v-model="form.mensagem"></textarea>
          </div>
          <div class="row justify-content-center">
            <div class="col-sm-7">
              <button type="submit"
                      class="btn btn-primary btn-block btn-lg rounded-pill"><?= $formulario['btn_enviar'] ?></button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
  <script><?= view('App/Contato/index.js.php') ?></script>
<?= partial_view('footer') ?>