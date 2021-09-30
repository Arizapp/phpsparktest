<?php
/**
 * @var SysConfig $config
 */

use App\Entities\SysConfig;
use App\Libraries\Admin\Auth;

echo view('Admin/Partials/header', ['identifier' => $view ?? '']);
vendor_js('vue/vue');
vendor_js('bootstrap-tagsinput/bootstrap-tagsinput', true, false);
vendor_css('bootstrap-tagsinput/bootstrap-tagsinput', true, false);

$isSuper = Auth::getSharedInstance()->isSuper();
?>
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
                            <button class="btn btn-outline-light float-right rounded-sm" type="submit"
                                    title="<?= lang('Admin.btn-save') ?>">
								<?= lang('Admin.btn-save') ?> <i class="fas fa-save"></i>
                            </button>
                            <h4 class="m-0 pt-1"><i class="fas fa-tools"></i> <?= lang('Admin.Config.title') ?></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-tabs" id="page-tab" role="tablist" style="margin-left: -1px">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#tab-general" role="tab"
                               aria-controls="general" aria-selected="true"><?= lang('Admin.Config.Seo.title') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="content-tab" data-toggle="tab" href="#tab-content" role="tab"
                               aria-controls="content"
                               aria-selected="false"><?= lang('Admin.Config.Variables.title') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="links-tab" data-toggle="tab" href="#tab-social-media" role="tab"
                               aria-controls="links"
                               aria-selected="false"><?= lang('Admin.Config.SocialMedia.title') ?></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="page-tab-content">
                        <div class="tab-pane fade show active" id="tab-general" role="tabpanel"
                             aria-labelledby="general-tab">
							<?= view('Admin/Config/edit/general', compact(['config', 'isSuper'])) ?>
                        </div>
                        <div class="tab-pane fade" id="tab-content" role="tabpanel" aria-labelledby="content-tab">
							<?= view('Admin/Config/edit/content', compact(['config', 'isSuper'])) ?>
                        </div>
                        <div class="tab-pane fade p-3" id="tab-social-media" role="tabpanel"
                             aria-labelledby="links-tab">
							<?= view('Admin/Config/edit/social_media', compact(['config', 'isSuper'])) ?>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
<?= view('Admin/Partials/footer') ?>