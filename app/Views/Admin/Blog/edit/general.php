<?php
/**
 * @var \App\Entities\SysBlog $blog
 */

?>

<div class="accordion" id="accordionGeneral">
    <div class="accordion-heading" id="headingSeo"
         data-toggle="collapse" data-target="#collapseSeo"
         aria-expanded="true" aria-controls="collapseSeo">
        Geral
    </div>
    <div class="p-3 collapse show" id="collapseSeo" aria-labelledby="headingSeo" data-parent="#accordionGeneral">
        <div class="form-group">
            <label for="input-uri">Link principal</label>
            <input type="text" class="form-control" id="input-uri" name="uri" aria-describedby="help-uri"
                   value="<?= $blog->uri ?>" <?= !$isSuper ? 'readonly' : '' ?>>
            <small id="help-uri" class="form-text text-muted"><a target="_blank" href="<?= site_url($blog->uri) ?>"><?= site_url($blog->uri) ?></a>
            </small>
        </div>
        <div class="form-group">
            <label for="input-title">Título</label>
            <input type="text" class="form-control" id="input-title"
                   name="title" value="<?= $blog->title ?>">
            <small class="form-text text-muted">title</small>
        </div>
    </div>
    <div class="accordion-heading collapsed" id="headingFacebook"
         data-toggle="collapse" data-target="#collapseFacebook"
         aria-expanded="true" aria-controls="collapseFacebook">
        Facebook
    </div>
    <div class="p-3 collapse" id="collapseFacebook" aria-labelledby="headingFacebook" data-parent="#accordionGeneral">
        <div class="form-group">
            <label for="input-facebook-image">Imagem</label><br>
            <img class="img-thumbnail img-fluid shadow" id="facebook-preview"
                 src="<?= img_uploaded_url($blog->meta_og_image) ?>"
                 style="cursor: pointer" onclick="ImageUpload.onClick('input-facebook-image')"/>
            <div class="custom-file">
                <input type="file" name="meta_og_image" class="custom-file-input" id="input-facebook-image"
                       onchange="ImageUpload.onChange(event,'facebook-preview')">
                <label class="custom-file-label" for="input-facebook-image"
                       data-browse="Escolher Imagem"></label>
            </div>
            <small class="form-text text-muted">og:image</small>
        </div>
        <div class="form-group">
            <label for="input-title">Título</label>
            <input type="text" class="form-control" id="input-facebook-title"
                   name="meta_og_title" value="<?= $blog->meta_og_title ?>">
            <small class="form-text text-muted">og:title</small>
        </div>
        <div class="form-group">
            <label for="input-meta-og-description">Descrição</label>
            <input type="text" class="form-control" id="input-meta-og-description"
                   name="meta_og_description" value="<?= $blog->meta_og_description ?>">
            <small class="form-text text-muted">og:description</small>
        </div>
    </div>
    <div class="accordion-heading collapsed" id="headingTwitter"
         data-toggle="collapse" data-target="#collapseTwitter"
         aria-expanded="true" aria-controls="collapseTwitter">
        Twitter
    </div>
    <div class="p-3 collapse" id="collapseTwitter" aria-labelledby="headingTwitter" data-parent="#accordionGeneral">
        <div class="form-group">
            <label for="input-twitter-image">Imagem</label><br>
            <img class="img-thumbnail img-fluid shadow" id="twitter-preview"
                 src="<?= img_uploaded_url($blog->meta_twitter_image) ?>"
                 style="cursor: pointer" onclick="ImageUpload.onClick('input-twitter-image')"/>
            <div class="custom-file">
                <input type="file" name="meta_twitter_image" class="custom-file-input" id="input-twitter-image"
                       onchange="ImageUpload.onChange(event,'twitter-preview')">
                <label class="custom-file-label" for="input-twitter-image"
                       data-browse="Escolher Imagem"></label>
            </div>
            <small class="form-text text-muted">twitter:image</small>
        </div>
        <div class="form-group">
            <label for="input-title">Título</label>
            <input type="text" class="form-control" id="input-twitter-title"
                   name="meta_twitter_title" value="<?= $blog->meta_twitter_title ?>">
            <small class="form-text text-muted">twitter:title</small>
        </div>
        <div class="form-group">
            <label for="input-meta-twitter-description">Descrição</label>
            <input type="text" class="form-control" id="input-meta-twitter-description"
                   name="meta_twitter_description" value="<?= $blog->meta_twitter_description ?>">
            <small class="form-text text-muted">twitter:description</small>
        </div>
        <div class="form-group">
            <label for="input-title">Site</label>
            <input type="text" class="form-control" id="input-twitter-site"
                   name="meta_twitter_site" value="<?= $blog->meta_twitter_site ?>">
            <small class="form-text text-muted">twitter:site</small>
        </div>
        <div class="form-group">
            <label for="input-title">Criador</label>
            <input type="text" class="form-control" id="input-twitter-creator"
                   name="meta_twitter_creator" value="<?= $blog->meta_twitter_creator ?>">
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