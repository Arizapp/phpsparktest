<?php
/**
 * @var array $post
 */

echo view('Admin/Partials/header', ['identifier' => $view]);
?>
    <div class="container">
        <form method="post" action="<?= current_url() ?>">
			<?= csrf_field() ?>
			<?php if (isset($error)): ?>
                <div class="alert alert-danger text-center mb-3"><?= $error ?></div>
			<?php endif; ?>
            <div class="card mb-3">
                <div class="card-header text-white bg-primary">
                    <button type="submit" class="btn btn-outline-white rounded-sm float-right">
                        Salvar <i class="fas fa-save"></i>
                    </button>
                    <h4 class="m-0 py-1"><i class="far fa-file-powerpoint"></i> <?= lang('Admin.Pages.label-newPage') ?></h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="input-uri"><?= lang('Admin.Pages.General.label-mainLink') ?></label>
                        <input type="text" class="form-control" id="input-uri" name="uri" aria-describedby="help-uri"
                               value="<?= $post['uri'] ?? '' ?>" required>
                        <small id="help-uri"
                               class="form-text text-muted"><?= lang('Admin.Pages.General.help-mainLink', ['.']) ?></small>
                    </div>
                    <div class="form-group">
                        <label for="input-route"><?= lang('Admin.Pages.General.label-route') ?></label>
                        <input type="text" class="form-control" id="input-route" name="route"
                               aria-describedby="help-route"
                               value="<?= $post['route'] ?? '' ?>" required>
                        <small id="help-route"
                               class="form-text text-muted"><?= lang('Admin.Pages.General.help-route') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="input-route-filter">Filtro da Rota</label>
                        <input type="text" class="form-control" id="input-route-filter" name="route_filter"
                               value="<?= $post['route_filter'] ?? '' ?>">
                    </div>
                </div>
            </div>
        </form>
    </div>
<?= view('Admin/Partials/footer') ?>