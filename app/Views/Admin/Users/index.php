<?php
/**
 * @var \App\Entities\SysUser[]    $users
 * @var \App\Entities\SysProfile[] $profiles
 */

echo view('Admin/Partials/header', ['identifier' => $view ?? '']);

use App\Libraries\Admin\Auth; ?>
<div class="container">
	<?php if (isset($error)): ?>
        <div class="alert alert-danger text-center mb-3"><?= $error ?></div>
	<?php endif; ?>
    <div class="card shadow border-bottom-primary mb-3">
        <form action="<?= current_url() ?>" method="post">
			<?= csrf_field() ?>
            <div class="card-header text-white bg-primary">
                <div class="row align-items-center">
                    <div class="col">
                        <button class="btn btn-outline-light float-right rounded-sm" type="submit"
                                title="<?= lang('Admin.btn-save') ?>">
							<?= lang('Admin.btn-save') ?> <i class="fas fa-save"></i>
                        </button>
                        <h4 class="m-0 pt-1"><i class="fas fa-user"></i> <?= lang('Admin.Config.title') ?></h4>
                    </div>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Alterar Senha</th>
                        <th>Perfil</th>
                        <th>Desabilitar</th>
                    </tr>
                </thead>
                <tbody>
					<?php foreach ($users as $key => $user): ?>
						<?php if ($user->id == 1 && Auth::getSharedInstance()->user()->id != 1) continue; ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="users[<?= $key ?>][id]" value="<?= $user->id ?>">
                                    <input type="text" name="users[<?= $key ?>][name]" value="<?= $user->name ?>"
                                           class="form-control"
                                           required>
                                </td>
                                <td>
                                    <input type="email" name="users[<?= $key ?>][email]" value="<?= $user->email ?>"
                                           class="form-control" required>
                                </td>
                                <td>
                                    <input type="password" name="users[<?= $key ?>][password]" value=""
                                           class="form-control"
                                           autocorrect="off" spellcheck="false" autocomplete="off" readonly
                                           onfocus="this.removeAttribute('readonly');">
                                </td>
                                <td>
									<?php if ($user->id == 1): ?>
                                        <input type="hidden" name="users[<?= $key ?>][sys_profile_id]"
                                               value="<?= $user->sys_profile_id ?>">
                                        <div class="form-control-plaintext"><?= $user->profile->name ?></div>
									<?php else: ?>
                                        <select name="users[<?= $key ?>][sys_profile_id]" class="form-control">
											<?php foreach ($profiles as $profile): ?>
                                                <option value="<?= $profile->id ?>" <?= $profile->id == $user->sys_profile_id ? 'selected' : '' ?>><?= $profile->name ?></option>
											<?php endforeach; ?>
                                        </select>
									<?php endif; ?>
                                </td>
                                <td>
									<?php if ($user->id != 1): ?>
                                        <div class="custom-control custom-switch text-center mt-2">
                                            <input type="checkbox"
                                                   name="users[<?= $key ?>][disabled]" <?= $user->disabled ? 'checked' : '' ?>
                                                   id="input-profile-<?= $user->id ?>"
                                                   class="custom-control-input">
                                            <label class="custom-control-label"
                                                   for="input-profile-<?= $user->id ?>"></label>
                                        </div>
									<?php endif; ?>
                                </td>
                            </tr>
					<?php endforeach; ?>
                </tbody>
            </table>
        </form>
        <div class="card-footer bg-gray-light">
            <div class="row justify-content-end">
                <div class="col-sm-4">
                    <form action="<?= site_url('admin/usuarios/add') ?>" method="post">
						<?= csrf_field() ?>
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                            <div class="input-group-append">
                                <button class="btn btn-gray-medium text-dark" type="submit">Adicionar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('Admin/Partials/footer') ?>


