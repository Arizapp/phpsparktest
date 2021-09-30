<?php
/**
 * @var SysPage[] $pages
 * @var SysPage   $page
 * @var string    $tab
 */

use App\Entities\SysPage;
use App\Libraries\Admin\Auth;

echo view('Admin/Partials/header', [
	'identifier' => $view ?? '',
	'extra_tags' => [
		vendor_js('vue/vue', false),
		vendor_js('bootstrap-tagsinput/bootstrap-tagsinput', false, false),
		vendor_css('bootstrap-tagsinput/bootstrap-tagsinput', false, false),
		vendor_js('datatables/jquery.dataTables', false),
		vendor_js('datatables/dataTables.bootstrap4', false),
		vendor_css('datatables/jquery.dataTables', false),
		vendor_css('datatables/dataTables.bootstrap4', false),
	],
]);

$isSuper = Auth::getSharedInstance()->isSuper();
?>
    <script>
        Vue.config.devtools = true;
    </script>
    <div class="container">
		<?php if (isset($error)): ?>
            <div class="alert alert-danger text-center mb-3"><?= $error ?></div>
		<?php endif; ?>
        <div class="card shadow border-bottom-primary mb-3">
            <div class="card-header text-white bg-primary">Blog</div>
            <div class="card-body p-0">
                <ul class="nav nav-tabs" id="blog-tab" role="tablist" style="margin-left: -1px">
                    <li class="nav-item">
                        <a class="nav-link <?= $tab == 'general' ? 'active' : '' ?>" id="general-tab"
                           data-toggle="tab" href="#tab-general" role="tab" onclick="tabOnClick('general')"
                           aria-controls="general" aria-selected="true">Geral</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $tab == 'categories' ? 'active' : '' ?>" id="categories-tab"
                           data-toggle="tab" href="#tab-categories" role="tab" onclick="tabOnClick('categories')"
                           aria-controls="categories" aria-selected="false">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $tab == 'posts' ? 'active' : '' ?>" id="posts-tab"
                           data-toggle="tab" href="#tab-posts" role="tab" onclick="tabOnClick('posts')"
                           aria-controls="posts" aria-selected="false">Postagens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $tab == 'new' ? 'active' : '' ?>" id="links-tab" data-toggle="tab"
                           href="#tab-new" role="tab" onclick="tabOnClick('new')"
                           aria-controls="new" aria-selected="false">Novo</a>
                    </li>
                </ul>
                <div class="tab-content" id="blog-tab-content">
                    <div class="tab-pane fade <?= $tab == 'general' ? 'show active' : '' ?>" id="tab-general"
                         role="tabpanel"
                         aria-labelledby="general-tab">
                        <form method="post" action="<?= current_url() ?>" enctype="multipart/form-data">
							<?= csrf_field() ?>
                            <input type="hidden" name="tab" id="input-tab" value="<?= $tab ?>">
                            <input type="hidden" name="section" value="general">
							<?= view('Admin/Blog/edit/general', compact(['blog', 'isSuper'])) ?>
                        </form>
                    </div>
                    <div class="tab-pane fade p-3 <?= $tab == 'categories' ? 'show active' : '' ?>" id="tab-categories"
                         role="tabpanel" aria-labelledby="categories-tab">
                        <form method="post" action="<?= current_url() ?>" enctype="multipart/form-data">
							<?= csrf_field() ?>
                            <input type="hidden" name="tab" id="input-tab" value="<?= $tab ?>">
                            <input type="hidden" name="section" value="categories">
							<?= view('Admin/Blog/edit/categories', compact(['blog', 'isSuper'])) ?>
                        </form>
                    </div>
                    <div class="tab-pane fade <?= $tab == 'posts' ? 'show active' : '' ?>" id="tab-posts"
                         role="tabpanel" aria-labelledby="posts-tab">
                        <form method="post" action="<?= current_url() ?>" enctype="multipart/form-data">
							<?= csrf_field() ?>
                            <input type="hidden" name="tab" id="input-tab" value="<?= $tab ?>">
                            <input type="hidden" name="section" value="posts">
							<?= view('Admin/Blog/edit/posts', compact(['blog', 'isSuper'])) ?>
                        </form>
                    </div>
                    <div class="tab-pane fade p-3 <?= $tab == 'new' ? 'show active' : '' ?>" id="tab-new"
                         role="tabpanel" aria-labelledby="new-tab">
                        <form method="post" action="<?= current_url() ?>" enctype="multipart/form-data">
							<?= csrf_field() ?>
                            <input type="hidden" name="tab" id="input-tab" value="<?= $tab ?>">
                            <input type="hidden" name="section" value="new">
							<?= view('Admin/Blog/edit/new', compact(['blog', 'isSuper'])) ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const tabOnClick = tab => {
            $("#input-tab").val(tab);
        };
    </script>
<?= view('Admin/Partials/footer') ?>