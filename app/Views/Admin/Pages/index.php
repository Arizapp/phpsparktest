<?php
/**
 * @var SysPage[] $pages
 * @var SysPage   $page
 */

use App\Entities\SysPage;
use App\Libraries\Admin\Auth;


echo view('Admin/Partials/header', ['identifier' => $view]);

$isSuper = Auth::getSharedInstance()->isSuper();
?>
    <div class="container">
        <div class="card mb-3">
            <div class="card-header text-white bg-primary">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="m-0"><i class="far fa-file-powerpoint"></i> <?= lang('Admin.Pages.title') ?></h4>
                    </div>
                    <div class="col-md-4">
						<?php if ($isSuper): ?>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <a class="btn btn-outline-light" title="<?= lang('Admin.Pages.btn-new') ?>"
                                   href="<?= site_url('admin/paginas/nova') ?>">
									<?= lang('Admin.Pages.btn-new') ?> <i class="fas fa-plus"></i>
                                </a>
                            </div>
							<?php endif; ?>
                            <select class="form-control float-right" onchange="gotoPage(this)">
                                <option value="" selected disabled
                                        hidden><?= lang('Admin.Pages.help-selectPage') ?></option>
								<?php foreach ($pages as $page): ?>
                                    <option value="<?= $page->uri ?>"><?= $page->title ?? $page->uri ?></option>
								<?php endforeach; ?>
                            </select>
							<?php if ($isSuper): ?>
                        </div>
					<?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-body <?= $isSuper ? 'p-0' : '' ?>">
				<?php if ($isSuper): ?>
                    <ul class="list-group list-group-flush">
						<?php foreach ($pages as $page): ?>
                            <li class="list-group-item bg-transparent">
                                <a href="<?= site_url('admin/pagina/' . $page->uri) ?>"
                                   class="text-decoration-none text-dark">
									<?= $page->title ?? $page->uri ?>
                                </a>
                                <a onclick="return confirm('Tem certeza que deseja deletar a página?')"
                                   class="btn btn-sm btn-danger float-right"
                                   href="<?= site_url('admin/pagina/del/' . $page->id) ?>">
                                    Delete
                                </a>
                            </li>
						<?php endforeach; ?>
                    </ul>
				<?php else: ?>
                    <p class="card-text text-center"><?= lang('Admin.Pages.help-noPageSelected') ?></p>
				<?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        const gotoPage = obj => {
            document.location.href = '<?= site_url('admin/pagina') ?>/' + $(obj).val();
        };
    </script>
<?= view('Admin/Partials/footer') ?>