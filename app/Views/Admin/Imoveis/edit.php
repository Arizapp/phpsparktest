<?php
/**
 * @var string $view
 * @var array  $cidades
 * @var array  $form
 */

use App\Libraries\Admin\Auth;

echo view('Admin/Partials/header', ['identifier' => $view]);
vendor_js('bootstrap-select/bootstrap-select');
vendor_js('bootstrap-select/defaults-pt_BR');
vendor_css('bootstrap-select/bootstrap-select');
vendor_js('easy-autocomplete/jquery.easy-autocomplete');
vendor_css('easy-autocomplete/easy-autocomplete');

$isSuper = Auth::getSharedInstance()->isSuper();
$id = $form['id'];
?>
  <div class="container mb-5">
      <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center">
          <strong><?= $error['title'] ?></strong>
            <?php if (!empty($error['message'])): ?>
              <br><?= $error['message'] ?>
            <?php endif; ?>
        </div>
      <?php endif; ?>
    <form method="post" action="<?= current_url() ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= $form['id'] ?>">
      <div class="card mb-3">
        <div class="card-header text-white bg-primary">
          <div class="row align-items-center">
            <div class="col">
              <h4 class="m-0">
                <i class="fas fa-home"></i> Imóvel
                <small>
                  #<?= $form['id'] ?>
                </small>
              </h4>
            </div>
            <div class="col ml-auto text-right">
              <div class="btn-group btn-group-toggle d-inline-block mr-2" data-toggle="buttons">
                <label class="btn btn-outline-light">
                  <input type="radio" name="publicado" id="input-publicado-2" autocomplete="off"
                         value="0" <?= empty($form['publicado']) ? 'checked' : '' ?>> Ocultar
                </label><label class="btn btn-outline-light active">
                  <input type="radio" name="publicado" id="input-publicado-1" autocomplete="off"
                         value="1" <?= (!empty($form['publicado'])) ? 'checked' : '' ?>> Publicar
                </label>
              </div>
              <button type="submit" class="btn btn-outline-light" title="Salvar">
                Salvar <i class="fas fa-save"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-row mb-3">
            <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
              <label class="btn btn-outline-primary col-sm-4">
                <input type="radio" id="input-tipo-v" name="tipo" class="custom-control-input"
                       value="V" <?= (!empty($form['tipo']) && $form['tipo'] == 'V') ? 'checked' : '' ?><?= empty($form['tipo']) ? 'checked' : '' ?>>
                Venda
              </label><label class="btn btn-outline-primary col-sm-4">
                <input type="radio" id="input-tipo-a" name="tipo" class="custom-control-input"
                       value="A" <?= (!empty($form['tipo']) && $form['tipo'] == 'A') ? 'checked' : '' ?>> Aluguel
              </label><label class="btn btn-outline-primary col-sm-4">
                <input type="radio" id="input-tipo-i" name="tipo" class="custom-control-input"
                       value="I" <?= (!empty($form['tipo']) && $form['tipo'] == 'I') ? 'checked' : '' ?>> Investimento
              </label>
            </div>
          </div>
          <div class="form-row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="input-cidade">Cidade</label>
                <select class="form-control selectpicker show-tick"
                        id="input-cidade"
                        name="sys_city_id"
                        data-live-search="true"
                        title="Selecione uma cidade..."
                        onchange="Bairros.setCidade(this)">
                    <?php foreach ($cidades as $estado => $municipios): ?>
                      <optgroup label="<?= $estado ?>">
                          <?php foreach ($municipios as $municipio): ?>
                            <option <?= $municipio->capital ? 'data-subtext="Capital"' : '' ?>
                                value="<?= $municipio->id ?>" <?= (!empty($form['sys_city_id']) && $form['sys_city_id'] == $municipio->id) ? 'selected' : '' ?>>
                                <?= $municipio->name ?>
                            </option>
                          <?php endforeach; ?>
                      </optgroup>
                    <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="input-bairro">Bairro</label>
                <div class="search-wrapper">
                  <i class="fas fa-search search-icon text-gray-medium-dark"></i>
                  <input type="text" autocomplete="off" id="input-bairro" name="bairro" class="form-control"
                         value="<?= !empty($form['bairro']) ? $form['bairro'] : '' ?>"/>
                </div>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-sm-9">
              <div class="form-group">
                <label for="input-titulo">Título</label>
                <input type="text" id="input-titulo" name="titulo" class="form-control"
                       value="<?= !empty($form['titulo']) ? $form['titulo'] : '' ?>"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="input-valor">Valor</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">R$</span>
                  </div>
                  <input type="text" id="input-valor" name="valor" class="form-control mask-money"
                         value="<?= !empty($form['valor']) ? $form['valor'] : '' ?>"/>
                </div>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-sm-3">
              <div class="form-group">
                <label for="input-quartos">Quartos</label>
                <input type="text" id="input-quartos" name="quartos" class="form-control mask-numbers"
                       value="<?= !empty($form['quartos']) ? $form['quartos'] : '' ?>"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="input-vagas">Vagas</label>
                <input type="text" id="input-vagas" name="vagas" class="form-control mask-numbers"
                       value="<?= !empty($form['vagas']) ? $form['vagas'] : '' ?>"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="input-area-construida">Área Construída</label>
                <div class="input-group">
                  <input type="text" id="input-area-construida" name="area_construida"
                         class="form-control mask-numbers"
                         value="<?= !empty($form['area_construida']) ? $form['area_construida'] : '' ?>"/>
                  <div class="input-group-append">
                    <span class="input-group-text">m²</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="input-area-total">Área Total</label>
                <div class="input-group">
                  <input type="text" id="input-area-total" name="area_total" class="form-control mask-numbers"
                         value="<?= !empty($form['area_total']) ? $form['area_total'] : '' ?>"/>
                  <div class="input-group-append">
                    <span class="input-group-text">m²</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-sm-3">
              <div class="form-group">
                <label for="input-telefone">Telefone</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-phone"></i>
                    </span>
                  </div>
                  <input type="tel" id="input-telefone" name="telefone" class="form-control mask-phone"
                         value="<?= !empty($form['telefone']) ? $form['telefone'] : '' ?>"/>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="input-whatsapp">Whatsapp</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fab fa-whatsapp"></i>
                    </span>
                  </div>
                  <input type="tel" id="input-whatsapp" name="whatsapp" class="form-control mask-phone"
                         value="<?= !empty($form['whatsapp']) ? $form['whatsapp'] : '' ?>"/>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="input-youtube">Youtube</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fab fa-youtube"></i>
                    </span>
                  </div>
                  <input type="text" id="input-youtube" name="youtube" class="form-control"
                         value="<?= !empty($form['youtube']) ? $form['youtube'] : '' ?>"/>
                </div>
              </div>
            </div>
            <div class="col-sm-2 mb-2 mb-sm-0">
              <label class="d-none d-sm-inline-block"></label>
              <div class="custom-control custom-checkbox mb-2 mb-sm-0">
                <input type="checkbox" class="custom-control-input" id="input-destaque" value="1" name="destaque"
                    <?= (!empty($form['destaque'])) ? 'checked' : '' ?>>
                <label class="custom-control-label" for="input-destaque">Destaque</label>
              </div>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="input-lancamento" name="lancamento" value="1"
                    <?= (!empty($form['lancamento'])) ? 'checked' : '' ?>>
                <label class="custom-control-label" for="input-lancamento">Lançamento</label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="input-mapa">Mapa <small class="text-gray">(código do google maps)</small></label>
                <textarea class="form-control code" name="mapa" id="input-mapa"
                          rows="4"><?= !empty($form['mapa']) ? $form['mapa'] : '' ?></textarea>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="input-sobre">Sobre</label>
                <textarea class="form-control" name="sobre" id="input-sobre"
                          rows="8"><?= !empty($form['sobre']) ? $form['sobre'] : '' ?></textarea>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="input-foto">Foto principal</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="foto" id="input-foto"/>
                  <label class="custom-file-label" for="input-foto">Escolha uma foto</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-sm-6">
              <figure class="figure">
                <img src="<?= img_uploaded_url($form['foto']) ?>" id="foto-preview"
                     class="figure-img img-fluid rounded"/>
              </figure>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <div class="form-group bg-gray-lighter px-3 py-2 rounded border">
                <label>Fotos adicionais</label>
                  <?= view('Admin/imoveis/edit/gallery', compact('fotos', 'id')) ?>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer bg-gray-light">
          <div class="row">
            <div class="col text-right">
              <button type="submit" class="btn btn-outline-gray-dark" title="Salvar">
                Salvar <i class="fas fa-save"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <style>
      .easy-autocomplete input {
          border-radius: 10px;
      }

      .search-wrapper {
          position: relative;
      }

      .search-icon {
          position: absolute;
          right: 10px;
          top: 50%;
          transform: translateY(-50%);
          z-index: 10;
      }

      .bootstrap-select.form-control {
          border: 1px solid #ced4da;
          border-radius: 10px;
      }

      .bootstrap-select .dropdown-toggle {
          border-radius: 10px;
          background: transparent;
      }
  </style>
  <script>
      const Bairros = {
          cidade: <?= !empty($form['sys_city_id']) ? $form['sys_city_id'] : 'null' ?>,
          setCidade: function (input) {
              Bairros.cidade = $(input).val();
          },
          init: function () {
              $("#input-bairro").easyAutocomplete(Bairros.options);
          },
          options: {
              url: "<?= site_url('admin/api/bairros') ?>",
              getValue: "bairro",
              template: {
                  type: "description",
                  fields: {
                      description: "cidade"
                  }
              },
              ajaxSettings: {
                  dataType: "json",
                  method: "POST",
                  headers: {'X-CSRF-TOKEN': '<?= csrf_hash() ?>'},
                  data: {
                      dataType: "json"
                  }
              },
              preparePostData: function (data) {
                  data.cidade = Bairros.cidade;
                  data.busca = $("#input-bairro").val();
                  return data;
              },
              requestDelay: 400
          }
      };
      $(function () {
              Bairros.init();
              $("#input-foto").change(function (event) {
                  if (this.files && this.files[0]) {
                      const reader = new FileReader();
                      let filename = $(this).val();
                      filename = filename.substring(filename.lastIndexOf('\\') + 1);
                      reader.onload = function (e) {
                          $('#foto-preview').attr('src', e.target.result).removeClass('d-none');
                          $('.custom-file-label').text(filename);
                      }
                      reader.readAsDataURL(this.files[0]);
                  }
              });
          }
      );
  </script>
<?= view('Admin/Partials/footer') ?>