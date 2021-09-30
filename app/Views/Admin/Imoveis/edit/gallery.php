<?php
/**
 * @var array $fotos
 * @var int   $id
 */

use App\Entities\SysPageVariable;

vendor_js('vue/vue');
?>
<template id="gallery">
  <div class="row">
    <div class="col-md-3 mb-3 gallery" v-for="(item, index) in items">
      <div class="picture h-100 border rounded-sm shadow d-block"
           :style="[ item.image ? { backgroundImage: 'url(\'<?= img_uploaded_url() ?>/' + item.image + '\')' } : { backgroundColor: 'white'} ]">
        <div class="gallery-menu" v-if="item.image">
          <i class="fas fa-arrow-left fa-fw fa-2x" v-if="index > 0"
             @click="onLeft(index)"></i>
          <i class="fas fa-arrow-right fa-fw fa-2x"
             v-if="index < (items.length - 1)"
             @click="onRight(index)"></i>
          <i class="far fa-trash-alt fa-fw fa-2x"
             @click="onDelete(index)"></i>
          <i class="fas fa-circle fa-fw"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3 gallery" v-if="!loading">
      <div class="picture h-100 border rounded-sm shadow d-block bg-white">
        <input type="file" @change="onChange($event)" accept="image/*" id="gallery_add_input">
        <div class="add"
             @click="onClick()">
          <i class="fas fa-plus fa-fw fa-4x"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3 gallery" v-if="loading">
      <div class="picture h-100 border rounded-sm shadow d-block bg-white">
        <div class="loading">
          <div class="wrapper">
            <i class="fas fa-circle-notch fa-spin fa-4x"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
    new Vue({
        el: '#gallery',
        data: {
            items: <?= json_encode($fotos, JSON_NUMERIC_CHECK) ?>,
            loading: false,
        },
        methods: {
            galleryOnAdd: function (variable) {
                variable.value.push({
                    id: null,
                    sys_page_variable_id: variable.id,
                    image: null,
                    title: null,
                    description: null,
                    url: null,
                    url_external: false,
                    order: 0,
                    action: 'none'
                });
            },
            onDelete: function (index) {
                this.loading = true;
                const id = this.items[index].id;

                $.ajax({
                    url: "<?= site_url('admin/api/imoveis/gallery/delete') ?>",
                    type: "POST",
                    data: {id},
                    headers: {'X-CSRF-TOKEN': '<?= csrf_hash() ?>'},
                }).done((data) => {
                    this.items = data;
                }).fail(function (e) {
                    console.error(e);
                }).always(() => {
                    this.loading = false;
                });
            },
            onLeft: function (index) {
                this.order(index, index - 1);
            },
            onRight: function (index) {
                this.order(index, index + 1);
            },
            order: function (index1, index2) {
                if (typeof this.items[index2] === 'undefined') {
                    return;
                }

                const id1 = this.items[index1].id;
                const id2 = this.items[index2].id;
                const order1 = this.items[index2].order;
                const order2 = this.items[index1].order;
                this.loading = true;

                $.ajax({
                    url: "<?= site_url('admin/api/imoveis/gallery/order') ?>",
                    type: "POST",
                    data: {id1, order1, id2, order2},
                    headers: {'X-CSRF-TOKEN': '<?= csrf_hash() ?>'},
                }).done(() => {
                    this.items[index1].order = order1;
                    this.items[index2].order = order2;

                    const item1 = this.items[index1];

                    this.items[index1] = this.items[index2];
                    this.items[index2] = item1;

                    this.$forceUpdate();
                }).fail(function (e) {
                    console.error(e);
                }).always(() => {
                    this.loading = false;
                });
            },
            onClick: function () {
                const elementName = 'gallery_add_input';
                const node = document.getElementById(elementName);
                if (node) {
                    if (document.createEvent) {
                        const evt = document.createEvent('MouseEvents');
                        evt.initEvent('click', true, false);
                        node.dispatchEvent(evt);
                    } else if (document.createEventObject) {
                        node.fireEvent('onclick');
                    } else if (typeof node.onclick == 'function') {
                        node.onclick();
                    }
                }
            },
            onChange: function (event) {
                console.log(event.target);
                if (event.target.files.length) {
                    this.loading = true;
                    console.log(event.target.files[0]);

                    const formData = new FormData();
                    formData.append("imovel_id", '<?= $id ?>');
                    formData.append("image", event.target.files[0]);
                    formData.append("order", this.items.length + 1);

                    $.ajax({
                        url: "<?= site_url('admin/api/imoveis/gallery/add') ?>",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        headers: {'X-CSRF-TOKEN': '<?= csrf_hash() ?>'},
                    }).done((data) => {
                        this.items.push(data);
                    }).fail(function (e) {
                        console.error(e);
                    }).always(() => {
                        this.loading = false;
                    });
                }
            }
        }
    });
</script>