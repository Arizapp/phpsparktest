<?php
echo view('Admin/Partials/header', ['identifier' => $view ?? '']);
vendor_js('vue/vue');

?>
<div class="container" id="product-categories">
    <div class="alert alert-danger text-center mb-3" v-if="error">
        <span v-text="error"></span>
        <button type="button" class="close" @click="error = null">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="card shadow border-bottom-primary mb-3">
        <div class="card-header text-white bg-primary">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="m-0 pt-1">
                        <i class="fas fa-list-ul" v-if="!loading"></i><i class="fas fa-sync fa-spin" v-if="loading"></i>
                        Categorias
                    </h4>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="name"
                               placeholder="<?= lang('Admin.btn-add') ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-gray-medium text-light" @click="add()"
                                    type="button" title="<?= lang('Admin.btn-add') ?>" :disabled="loading">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body">
            <div v-for="(category, index) in list" class="mb-2">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="category.name">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" @click="save(category)" :disabled="loading">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger" @click="del(category, index)" :disabled="loading">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new Vue({
        el: '#product-categories',
        data: {
            api: '<?= site_url('admin/api/produto/categorias') ?>/',
            headers: {'X-CSRF-TOKEN': '<?= csrf_hash() ?>'},
            name: '',
            list: [],
            loading: false,
            error: null,
        },
        created: function () {
            this.fetch();
        },
        methods: {
            save: function (category) {
                this.loading = true;
                $.ajax({
                    url: this.api + category.id,
                    type: 'PUT',
                    data: {category},
                    headers: this.headers,
                    dataType: 'json'
                }).always(() => {
                    this.fetch();
                });
            },
            del: function (category, index) {
                if (window.confirm("Tem certeza que deseja remover?")) {
                    this.list.splice(index, 1);
                    this.loading = true;
                    this.error = null;
                    $.ajax({
                        url: this.api + category.id,
                        type: 'DELETE',
                        headers: this.headers
                    }).fail((response) => {
                        this.error = response.statusText;
                    }).always(() => {
                        this.fetch();
                    });
                }
            },
            add: function () {
                if (!this.name.length) return;
                this.loading = true;
                this.error = null;
                const name = this.name;
                $.ajax({
                    url: this.api,
                    type: 'POST',
                    data: {name},
                    headers: this.headers,
                    dataType: 'json'
                }).fail((response) => {
                    this.error = response.statusText;
                }).always(() => {
                    this.fetch();
                });
            },
            fetch: function () {
                this.loading = true;
                this.name = '';
                $.get(this.api, (data) => {
                    this.list = data;
                }).always(() => {
                    this.loading = false;
                });
            }
        }
    });
</script>
<?= view('Admin/Partials/footer') ?>
