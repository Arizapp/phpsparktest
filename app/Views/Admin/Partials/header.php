<?php
/**
 * @var string $tags
 * @var string $description
 * @var string $identifier
 */
$identifier = $identifier ? str_replace('/', '-', $identifier) : '';
$tags = $tags ?? '';
$description = $description ?? '';
/* Extra tags */
$extra_tags = $extra_tags ?? [];

use App\Libraries\Admin\Auth; ?>
<!doctype html>
<html class="h-100">
<?= partial_view('head', [
	'tags'        => $tags,
	'description' => $description,
	'extra_tags'  => $extra_tags,
]) ?>
<body class="d-flex flex-column h-100 admin <?= $identifier ?>">
<header id="admin-header">
    <div class="fixed-top">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow">
            <a class="navbar-brand p-0" href="<?= site_url('admin') ?>">
				<?php img('LogoWhiteIco.svg', '', 'Minuto Advogado', 'height:32px') ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/imoveis') ?>"><i
                                    class="fas fa-home"></i> Imóveis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/paginas') ?>"><i
                                    class="far fa-file-powerpoint"></i>
							<?= lang('Admin.Menu.pages') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/config') ?>"><i
                                    class="fas fa-tools"></i> <?= lang('Admin.Menu.config') ?></a>
                    </li>
                </ul>
                <div class="form-inline mt-2 mt-md-0">
                    <span class="d-inline-block text-white mr-2"><?= Auth::getSharedInstance()->user()->name ?></span>
                    <div class="text-white cursor-pointer" data-toggle="dropdown" aria-haspopup="true"
                         aria-expanded="false">
                        <i class="far fa-caret-square-down fa-2x"></i>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right">
						<?php if (Auth::getSharedInstance()->isAdmin()): ?>
                            <a href="<?= site_url('admin/usuarios') ?>" class="dropdown-item" type="button"><i
                                        class="fas fa-user fa-fw"></i> <?= lang('Admin.Menu.users') ?></a>
						<?php endif; ?>
                        <a href="<?= site_url('admin/sair') ?>" class="dropdown-item" type="button"><i
                                    class="fas fa-sign-out-alt fa-fw"></i> <?= lang('Admin.Menu.exit') ?></a>
                    </div>
                </div>
            </div>
        </nav>
		<?php if (is_numeric(strpos($identifier, 'Admin-Products'))) echo view('Admin/Products/menu', compact('identifier')); ?>
    </div>
</header>
<main role="main" class="flex-shrink-0">