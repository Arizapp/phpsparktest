<?php
$db = db_connect();
$cidades = $db->query('SELECT * FROM cidades')->getResult();
$request = \Config\Services::request();
?>
<div class="container my-5" id="search">
  <div class="row justify-content-center">
    <div class="col-9">
      <form action="<?= site_url('imoveis/busca') ?>" method="get">
        <h1 class="text-center text-secondary pt-5 mb-5">ENCONTRE OS MELHORES IMÓVEIS</h1>
        <div class="form-row">
          <div class="col-sm-6">
            <div class="form-group">
              <select name="cidade" id="input-cidade" class="form-control form-control-lg rounded-pill"
                      onchange="Search.bairros()">
                <option value="">Selecione uma Cidade</option>
                  <?php foreach ($cidades as $cidade): ?>
                    <option value="<?= $cidade->id ?>"
                        <?php if ($request->getGet('cidade') && $request->getGet('cidade') == $cidade->id) echo 'selected'; ?>>
                        <?= $cidade->name ?>
                    </option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <select name="bairro" id="input-bairro" class="form-control form-control-lg rounded-pill">
                <option value="">Selecione o Bairro</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-6">
            <div class="form-group">
              <select name="quartos" id="input-quartos" class="form-control form-control-lg rounded-pill">
                <option value="">Número de quartos</option>
                <option value="1" <?= $request->getGet('quartos') == 1 ? 'selected' : '' ?>>1</option>
                <option value="2" <?= $request->getGet('quartos') == 2 ? 'selected' : '' ?>>2</option>
                <option value="3" <?= $request->getGet('quartos') == 3 ? 'selected' : '' ?>>3</option>
                <option value="4" <?= $request->getGet('quartos') == 4 ? 'selected' : '' ?>>4</option>
                <option value="5" <?= $request->getGet('quartos') == 5 ? 'selected' : '' ?>>5+</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <select name="valor" id="input-valor" class="form-control form-control-lg rounded-pill">
                <option value="">Média de valor</option>
                <option value="150" <?= $request->getGet('valor') == '150' ? 'selected' : '' ?>>Até 150 mil</option>
                <option value="250" <?= $request->getGet('valor') == '250' ? 'selected' : '' ?>>150 a 250 mil</option>
                <option value="350" <?= $request->getGet('valor') == '350' ? 'selected' : '' ?>>250 a 350 mil</option>
                <option value="450" <?= $request->getGet('valor') == '450' ? 'selected' : '' ?>>350 a 450 mil</option>
                <option value="550" <?= $request->getGet('valor') == '550' ? 'selected' : '' ?>>450 a 550 mil</option>
                <option value="999" <?= $request->getGet('valor') == '999' ? 'selected' : '' ?>>> 550 mil</option>
              </select>
            </div>
          </div>
        </div>
        <button class="btn btn-block btn-lg btn-secondary rounded-pill" type="submit">Buscar imóvel</button>
      </form>
    </div>
  </div>
</div>
<script>

    const Search = {
        init: function () {
            <?php if($request->getGet('cidade')): ?>
            Search.bairros('<?= $request->getGet('bairro') ?>');
            <?php endif; ?>
        },
        bairros: function (selected) {
            const bairros = $("#input-bairro");
            bairros.empty();
            $('<option />').attr('value', '').text('Selecione o Bairro').appendTo(bairros);
            $.ajax({
                method: "POST",
                headers: {'X-CSRF-TOKEN': '<?= csrf_hash() ?>'},
                url: "<?= site_url('api/bairros') ?>",
                dataType: "json",
                data: {
                    cidade: $('#input-cidade').val()
                }
            }).done(function (data) {
                for (let item in data) {
                    let opt = $('<option />').attr('value', data[item].bairro).text(data[item].bairro);
                    if (selected == data[item].bairro) opt.attr('selected', true);
                    opt.appendTo(bairros);
                }
            });
        }
    };

    $(function () {
        Search.init();
    });
</script>