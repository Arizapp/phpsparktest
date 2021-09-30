<?php
/**
 * @var string   $view
 * @var int      $cidade
 * @var object[] $cidades
 */

use App\Libraries\Admin\Auth;

echo view('Admin/Partials/header', ['identifier' => $view]);
vendor_js('datatables/jquery.dataTables');
vendor_css('datatables/datatables.bootstrap4');
vendor_js('datatables/datatables.bootstrap4');
vendor_js('string-mask/string-mask');

$isSuper = Auth::getSharedInstance()->isSuper();
if (isset($publicado) && is_int($publicado)) $publicado = (int)$publicado;

?>
  <div class="container">
    <div class="card mb-3">
      <div class="card-header text-white bg-primary">
        <div class="row align-items-center">
          <div class="col">
            <h4 class="m-0"><i class="fas fa-home"></i> Imóveis</h4>
          </div>
          <div class="col ml-auto text-right">
            <a class="btn btn-outline-light" title="Adicionar"
               href="<?= site_url('admin/imoveis/novo') ?>">
              Novo <i class="fas fa-plus"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-7 mb-2">
            <form method="get" action="<?= current_url() ?>" id="form-tipo">
                <?php if (!empty($cidade)): ?>
                  <input type="hidden" name="cidade" value="<?= $cidade ?>">
                <?php endif; ?>
                <?php if (!empty($publicado)): ?>
                  <input type="hidden" name="publicado" value="<?= $publicado ?>">
                <?php endif; ?>
              <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                <label class="btn btn-outline-primary col-sm-4">
                  <input type="radio" id="input-tipo-t" name="tipo" class="custom-control-input"
                         value="" <?= empty($tipo) ? 'checked' : '' ?> onclick="$('#form-tipo').submit()"> Todos
                </label><label class="btn btn-outline-primary col-sm-4">
                  <input type="radio" id="input-tipo-v" name="tipo" class="custom-control-input"
                         value="V" <?= (!empty($tipo) && $tipo == 'V') ? 'checked' : '' ?>
                         onclick="$('#form-tipo').submit()"> Venda
                </label><label class="btn btn-outline-primary col-sm-4">
                  <input type="radio" id="input-tipo-a" name="tipo" class="custom-control-input"
                         value="A" <?= (!empty($tipo) && $tipo == 'A') ? 'checked' : '' ?>
                         onclick="$('#form-tipo').submit()"> Aluguel
                </label><label class="btn btn-outline-primary col-sm-4">
                  <input type="radio" id="input-tipo-i" name="tipo" class="custom-control-input"
                         value="I" <?= (!empty($tipo) && $tipo == 'I') ? 'checked' : '' ?>
                         onclick="$('#form-tipo').submit()"> Investimento
                </label>
              </div>
            </form>
          </div>
          <div class="col-sm-5 mb-2">
            <form method="get" action="<?= current_url() ?>" id="form-publicado">
                <?php if (!empty($cidade)): ?>
                  <input type="hidden" name="cidade" value="<?= $cidade ?>">
                <?php endif; ?>
                <?php if (!empty($tipo)): ?>
                  <input type="hidden" name="tipo" value="<?= $tipo ?>">
                <?php endif; ?>
              <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                <label class="btn btn-outline-primary col-sm-4">
                  <input type="radio" id="input-publicado-t" name="publicado" class="custom-control-input"
                         value="" <?= !isset($publicado) ? 'checked' : '' ?>
                         onclick="$('#form-publicado').submit()"> Todos
                </label><label class="btn btn-outline-primary col-sm-4">
                  <input type="radio" id="input-publicado-o" name="publicado" class="custom-control-input"
                         value="0" <?= (isset($publicado) && $publicado == 0) ? 'checked' : '' ?>
                         onclick="$('#form-publicado').submit()"> Oculto
                </label><label class="btn btn-outline-primary col-sm-4">
                  <input type="radio" id="input-publicado-p" name="publicado" class="custom-control-input"
                         value="1" <?= (isset($publicado) && $publicado == 1) ? 'checked' : '' ?>
                         onclick="$('#form-publicado').submit()"> Publicado
                </label>
              </div>
            </form>
          </div>
        </div>
        <table class="table" id="imoveis-list">
          <thead>
          <tr>
            <th width="1">Foto</th>
            <th width="1">Código</th>
            <th width="1">Tipo</th>
            <th>Título</th>
            <th>Bairro</th>
            <th>Valor</th>
            <th>Telefone</th>
            <th width="1"></th>
          </tr>
          </thead>
        </table>
      </div>
    </div>
    <div class="d-none" id="form-cidade-wrapper">
      <form method="get" action="<?= current_url() ?>" id="form-cidade">
          <?php if (!empty($tipo)): ?>
            <input type="hidden" name="tipo" value="<?= $tipo ?>">
          <?php endif; ?>
          <?php if (!empty($publicado)): ?>
            <input type="hidden" name="publicado" value="<?= $publicado ?>">
          <?php endif; ?>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Cidade</span>
          </div>
          <select class="form-control" name="cidade" onchange="$('#form-cidade').submit()">
              <?php if (empty($cidade)): ?>
                <option value="">-- Selecione uma cidade</option>
              <?php else: ?>
                <option value="">-- Todas</option>
              <?php endif; ?>
              <?php foreach ($cidades as $sysCity): ?>
                <option <?= $sysCity->id == $cidade ? 'selected="true"' : '' ?> value="<?= $sysCity->id ?>">
                    <?= $sysCity->name ?> / <?= $sysCity->UF ?>
                </option>
              <?php endforeach; ?>
          </select>
        </div>
      </form>
    </div>
  </div>
  </div>
  <script>
      $(document).ready(function () {
          const ImoveisList = $('#imoveis-list').DataTable({
              "language": {
                  "url": "<?= vendor_url('datatables/Portuguese-Brasil.json') ?>"
              },
              "lengthChange": false,
              "processing": true,
              "serverSide": true,
              "ajax": "<?= site_url('admin/api/imoveis') ?>?cidade=<?= $cidade ?>&tipo=<?= $tipo ?>&publicado=<?= isset($publicado) ? $publicado : '' ?>",
              "columns": [
                  {"data": "foto", orderable: false},
                  {"data": "id"},
                  {"data": "tipo"},
                  {"data": "titulo"},
                  {"data": "bairro"},
                  {"data": "valor"},
                  {"data": "telefone", orderable: false},
                  {"data": "edit_id", orderable: false}
              ],
              "columnDefs":
                  [
                      {
                          "targets": 0,
                          "data": 'foto',
                          "render": function (data, type, row, meta) {
                              return '<a class="text-gray-medium-dark cursor-pointer" data-toggle="popover-hover" data-img="' + data + '">'
                                  + '<i class="far fa-2x fa-image"></i>'
                                  + '</a>';
                          }
                      },
                      {
                          "targets": 6,
                          "data": 'telefone',
                          "render": function (data, type, row, meta) {
                              data = data.replace(/\D/g, '');
                              let formatter = data.length === 11
                                  ? new StringMask('(00) 00000-0000')
                                  : new StringMask('(00) 0000-0000');
                              return formatter.apply(data);
                          }
                      },
                      {
                          "targets": 7,
                          "data": 'edit_id',
                          "render": function (data, type, row, meta) {
                              return '<div class="btn-group" role="group">'
                                  + '<a target="_blank" href="<?= site_url('admin/imovel') ?>/' + data + '" class="btn btn-sm btn-primary">'
                                  + '<i class="fas fa-pencil-alt"></i>'
                                  + '</a>'
                                  + '<a target="_blank" onclick="return confirm(\'Tem certeza que deseja remover o imóvel?\')" href="<?= site_url('admin/imovel/delete') ?>/' + data + '" class="btn btn-sm btn-danger">'
                                  + '<i class="fas fa-trash"></i>'
                                  + '</a>'
                                  + '</div>';
                          }
                      }
                  ],
              "order": [[1, 'desc']]
          });

          ImoveisList.on('draw.dt', function () {
              const ilw = $('#imoveis-list_wrapper > .row > .col-md-6').first();
              $('#form-cidade-wrapper').detach().appendTo(ilw).removeClass('d-none');

              $('[data-toggle="popover-hover"]').popover({
                  html: true,
                  trigger: 'hover',
                  placement: 'right',
                  content: function () {
                      return '<img src="' + $(this).data('img') + '" />';
                  }
              });
          });
      });
  </script>
<?= view('Admin/Partials/footer') ?>