<?php
/**
 * @var \App\Entities\SysPage $page
 */

?>
<div class="p-3">
    <div class="form-group">
        <label for="input-uri"><?= lang('Admin.Pages.General.label-mainLink') ?></label>
        <input type="text" class="form-control" id="input-uri" name="uri" aria-describedby="help-uri"
               value="<?= $page->uri ?>" <?= !$isSuper ? 'readonly' : '' ?>>
        <small id="help-uri" class="form-text text-muted"><?= lang('Admin.Pages.General.help-mainLink', [
				': <a target="_blank" href="' . site_url($page->uri) . '">' . site_url($page->uri) . '</a>',
			]) ?></small>
    </div>
	<?php if ($isSuper): ?>
        <div class="form-group">
            <label for="input-route"><?= lang('Admin.Pages.General.label-route') ?></label>
            <input type="text" class="form-control" id="input-route" name="route" aria-describedby="help-route"
                   value="<?= $page->route ?>">
            <small id="help-route" class="form-text text-muted"><?= lang('Admin.Pages.General.help-route') ?></small>
        </div>
        <div class="form-group">
            <label for="input-route-filter">Filtro da Rota</label>
            <input type="text" class="form-control" id="input-route-filter" name="route_filter"
                   value="<?= $page->route_filter ?>">
        </div>
	<?php endif; ?>
</div>
<div class="accordion" id="accordionGeneral">
    <div class="accordion-heading" id="headingSeo"
         data-toggle="collapse" data-target="#collapseSeo"
         aria-expanded="true" aria-controls="collapseSeo">
		<?= lang('Admin.Pages.General.Seo.title') ?>
    </div>
    <div class="p-3 collapse show" id="collapseSeo" aria-labelledby="headingSeo" data-parent="#accordionGeneral">
        <div class="form-group">
            <label for="input-title"><?= lang('Admin.Pages.General.Seo.label-title') ?></label>
            <input type="text" class="form-control" id="input-title" name="title"
                   aria-describedby="help-title" value="<?= $page->title ?>">
            <small class="form-text text-muted">title</small>
        </div>
        <div class="form-group">
            <label for="input-meta-description"><?= lang('Admin.Pages.General.Seo.label-description') ?></label>
            <input type="text" class="form-control" id="input-meta-description" name="meta_description"
                   aria-describedby="help-meta-description" value="<?= $page->meta_description ?>">
            <small class="form-text text-muted">description</small>
        </div>
        <div class="form-group">
            <label for="input-meta-keywords"><?= lang('Admin.Pages.General.Seo.label-keywords') ?>
                <small class="text-muted">(<?= lang('Admin.help-pressEnterToAdd') ?>)</small>
            </label>
            <input type="text" class="form-control" id="input-meta-keywords" name="meta_keywords"
                   aria-describedby="help-meta-keywords" value="<?= $page->meta_keywords ?>">
            <small class="form-text text-muted">keywords</small>
        </div>
    </div>
    <div class="accordion-heading collapsed" id="headingFacebook"
         data-toggle="collapse" data-target="#collapseFacebook"
         aria-expanded="false" aria-controls="collapseFacebook">
		<?= lang('Admin.Pages.General.Seo.Facebook.title') ?>
    </div>
    <div class="p-3 collapse" id="collapseFacebook" aria-labelledby="headingFacebook" data-parent="#accordionGeneral">
        <div class="form-group">
            <label for="input-facebook-image"><?= lang('Admin.Pages.General.Seo.Facebook.label-image') ?></label><br>
            <img class="img-thumbnail img-fluid shadow" id="facebook-preview"
                 src="<?= img_uploaded_url($page->meta_og_image) ?>"
                 style="cursor: pointer" onclick="ImageUpload.onClick('input-facebook-image')"/>
            <div class="custom-file">
                <input type="file" name="meta_og_image" class="custom-file-input" id="input-facebook-image"
                       onchange="ImageUpload.onChange(event,'facebook-preview')">
                <label class="custom-file-label" for="input-facebook-image"
                       data-browse="<?= lang('Admin.help-selectImage') ?>"></label>
            </div>
            <small class="form-text text-muted">og:image</small>
        </div>
        <div class="form-group">
            <label for="input-title"><?= lang('Admin.Pages.General.Seo.Facebook.label-title') ?></label>
            <input type="text" class="form-control" id="input-facebook-title"
                   name="meta_og_title" value="<?= $page->meta_og_title ?>">
            <small class="form-text text-muted">og:title</small>
        </div>
        <div class="form-group">
            <label for="input-meta-og-description"><?= lang('Admin.Pages.General.Seo.Facebook.label-description') ?></label>
            <input type="text" class="form-control" id="input-meta-og-description"
                   name="meta_og_description" value="<?= $page->meta_og_description ?>">
            <small class="form-text text-muted">og:description</small>
        </div>
    </div>
    <div class="accordion-heading collapsed" id="headingTwitter"
         data-toggle="collapse" data-target="#collapseTwitter"
         aria-expanded="false" aria-controls="collapseTwitter">
		<?= lang('Admin.Pages.General.Seo.Twitter.title') ?>
    </div>
    <div class="p-3 collapse" id="collapseTwitter" aria-labelledby="headingTwitter" data-parent="#accordionGeneral">
        <div class="form-group">
            <label for="input-twitter-image"><?= lang('Admin.Pages.General.Seo.Twitter.label-image') ?></label><br>
            <img class="img-thumbnail img-fluid shadow" id="twitter-preview"
                 src="<?= img_uploaded_url($page->meta_twitter_image) ?>"
                 style="cursor: pointer" onclick="ImageUpload.onClick('input-twitter-image')"/>
            <div class="custom-file">
                <input type="file" name="meta_twitter_image" class="custom-file-input" id="input-twitter-image"
                       onchange="ImageUpload.onChange(event,'twitter-preview')">
                <label class="custom-file-label" for="input-twitter-image"
                       data-browse="<?= lang('Admin.help-selectImage') ?>"></label>
            </div>
            <small class="form-text text-muted">twitter:image</small>
        </div>
        <div class="form-group">
            <label for="input-title"><?= lang('Admin.Pages.General.Seo.Twitter.label-title') ?></label>
            <input type="text" class="form-control" id="input-twitter-title"
                   name="meta_twitter_title" value="<?= $page->meta_twitter_title ?>">
            <small class="form-text text-muted">twitter:title</small>
        </div>
        <div class="form-group">
            <label for="input-meta-twitter-description"><?= lang('Admin.Pages.General.Seo.Twitter.label-description') ?></label>
            <input type="text" class="form-control" id="input-meta-twitter-description"
                   name="meta_twitter_description" value="<?= $page->meta_twitter_description ?>">
            <small class="form-text text-muted">twitter:description</small>
        </div>
        <div class="form-group">
            <label for="input-title"><?= lang('Admin.Pages.General.Seo.Twitter.label-site') ?></label>
            <input type="text" class="form-control" id="input-twitter-site"
                   name="meta_twitter_site" value="<?= $page->meta_twitter_site ?>">
            <small class="form-text text-muted">twitter:site</small>
        </div>
        <div class="form-group">
            <label for="input-title"><?= lang('Admin.Pages.General.Seo.Twitter.label-creator') ?></label>
            <input type="text" class="form-control" id="input-twitter-creator"
                   name="meta_twitter_creator" value="<?= $page->meta_twitter_creator ?>">
            <small class="form-text text-muted">twitter:creator</small>
        </div>
    </div>
</div>
<script>
    const ImageUpload = {
        onClick: function (id) {
            const node = document.getElementById(id);

            if (document.createEvent) {
                const evt = document.createEvent('MouseEvents');
                evt.initEvent('click', true, false);
                node.dispatchEvent(evt);
            } else if (document.createEventObject) {
                node.fireEvent('onclick');
            } else if (typeof node.onclick == 'function') {
                node.onclick();
            }
        },
        onChange: function (event, id) {
            if (event.target.files.length) {
                event.target.nextElementSibling.innerHTML = event.target.files[0].name;

                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById(id).src = e.target.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    };

    $(function () {
        $('#input-meta-keywords').tagsinput({
            tagClass: 'badge badge-primary'
        });
    });
</script>