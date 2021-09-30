<?php
/**
 * @var SysPage[] $pages
 * @var SysPage   $page
 */

use App\Entities\SysPage;
use App\Libraries\Admin\Auth;

echo view('Admin/Partials/header', ['identifier' => $view ?? '']);
vendor_js('vue/vue');
vendor_js('bootstrap-tagsinput/bootstrap-tagsinput', true, false);
vendor_css('bootstrap-tagsinput/bootstrap-tagsinput', true, false);

$isSuper = Auth::getSharedInstance()->isSuper();
?>
    <script>
        Vue.config.devtools = true;
    </script>
    <div class="container">
        <form method="post" action="<?= current_url() ?>" enctype="multipart/form-data">
			<?= csrf_field() ?>
			<?php if (isset($error)): ?>
                <div class="alert alert-danger text-center mb-3"><?= $error ?></div>
			<?php endif; ?>
            <div class="card shadow border-bottom-primary mb-3">
                <div class="card-header text-white bg-primary">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="m-0"><i class="far fa-file-powerpoint"></i> <?= $page->title ?? $page->uri ?>
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
								<?php if ($isSuper): ?>
                                    <div class="input-group-prepend">
                                        <a class="btn btn-outline-light" title="<?= lang('Admin.Pages.btn-new') ?>"
                                           href="<?= site_url('admin/paginas/nova') ?>">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
								<?php endif; ?>
                                <select class="form-control float-right" onchange="gotoPage(this)">
									<?php foreach ($pages as $p): ?>
                                        <option value="<?= $p->uri ?>"<?= $p->id == $page->id ? ' selected' : '' ?>><?= $p->title ?? $page->uri ?></option>
									<?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-light" type="submit" title="<?= lang('Admin.btn-save') ?>">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-tabs" id="page-tab" role="tablist" style="margin-left: -1px">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#tab-general" role="tab"
                               aria-controls="general" aria-selected="true"><?= lang('Admin.Pages.General.title') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="content-tab" data-toggle="tab" href="#tab-content" role="tab"
                               aria-controls="content" aria-selected="false"><?= lang('Admin.Pages.Content.title') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="links-tab" data-toggle="tab" href="#tab-links" role="tab"
                               aria-controls="links" aria-selected="false"><?= lang('Admin.Pages.Links.title') ?></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="page-tab-content">
                        <div class="tab-pane fade show active" id="tab-general" role="tabpanel"
                             aria-labelledby="general-tab">
							<?= view('Admin/Pages/edit/general', compact(['page', 'isSuper'])) ?>
                        </div>
                        <div class="tab-pane fade" id="tab-content" role="tabpanel" aria-labelledby="content-tab">
							<?= view('Admin/Pages/edit/content', compact(['page', 'isSuper'])) ?>
                        </div>
                        <div class="tab-pane fade p-3" id="tab-links" role="tabpanel" aria-labelledby="links-tab">
							<?= view('Admin/Pages/edit/links', compact(['page', 'isSuper'])) ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right border-top-0 bg-gray-light">
                    <button class="btn btn-primary rounded-sm" type="submit" title="<?= lang('Admin.btn-save') ?>">
						<?= lang('Admin.btn-save') ?> <i class="fas fa-save"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        const gotoPage = obj => {
            document.location.href = '<?= site_url('admin/pagina') ?>/' + $(obj).val();
        };
    </script>
<?= view('Admin/Partials/footer') ?>