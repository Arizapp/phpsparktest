<?php
/**
 * @var \App\Entities\SysPage $page
 */
?>
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-sm-4">
      <a href="<?= sys_config()->variables['link_portal_corretor']->value ?>"
         class="shadow border px-3 text-primary d-block position-relative text-decoration-none">
        <img src="<?= img_uploaded_url($page->variables['ico_portal_corretor']->value) ?>" class="float-left">
        <div class="py-3">
          Portal do <h2>Corretor</h2>
        </div>
        <img src="<?= img_uploaded_url($page->variables['ico_mouse_click']->value) ?>" alt=""
        class="position-absolute" style="left: 50%; transform: translateX(-50%); bottom: -25px">
      </a>
    </div>
    <div class="col-sm-4">
      <a href="<?= sys_config()->variables['link_portal_cliente']->value ?>"
         class="shadow border px-3 text-primary d-block position-relative text-decoration-none">
        <img src="<?= img_uploaded_url($page->variables['ico_portal_cliente']->value) ?>" class="float-left mr-3">
        <div class="py-3">
          Portal do <h2>Cliente</h2>
        </div>
        <img src="<?= img_uploaded_url($page->variables['ico_mouse_click']->value) ?>" alt=""
        class="position-absolute" style="left: 50%; transform: translateX(-50%); bottom: -25px">
      </a>
    </div>
    <div class="col-sm-4">
      <a href="<?= sys_config()->variables['link_venda_terreno']->value ?>"
         class="shadow border px-3 text-primary d-block position-relative text-decoration-none">
        <img src="<?= img_uploaded_url($page->variables['ico_venda_terreno']->value) ?>" class="float-left mr-2">
        <div class="py-3">
          Venda seu <h2>Terreno</h2>
        </div>
        <img src="<?= img_uploaded_url($page->variables['ico_mouse_click']->value) ?>" alt=""
        class="position-absolute" style="left: 50%; transform: translateX(-50%); bottom: -25px">
      </a>
    </div>
  </div>
</div>
