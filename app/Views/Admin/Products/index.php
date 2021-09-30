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
                        Produtos
                    </h4>
                </div>
                <div class="col-sm-7">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Categoria</div>
                        </div>
                        <select class="form-control" v-model="category" @change="fetch()">
                            <option disabled hidden selected value="">Selecione uma categoria</option>
                            <option v-for="item in categories" v-text="item.name" :value="item.id"></option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-outline-gray-medium text-light btn-block" @click="showAdd()"
                            v-if="!addPanel.show"
                            type="button" title="<?= lang('Admin.btn-add') ?>" :disabled="loading">
						<?= lang('Admin.btn-add') ?> <i class="fas fa-plus"></i>
                    </button>
                    <button class="btn btn-outline-gray-medium text-light btn-block" @click="clearAdd()"
                            v-if="addPanel.show"
                            type="button" title="<?= lang('Admin.btn-add') ?>" :disabled="loading">
                        Cancelar <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body text-center text-muted" v-if="!categories.length">
            Nenhuma categoria cadastrada<br/><br/>
            <a href="<?= site_url('admin/produtos/categorias') ?>" class="btn btn-primary">Cadastrar Categorias</a>
        </div>
        <table class="table" v-if="list.length">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th style="width: 300px">Nome</th>
                    <th>Unidade</th>
                    <th>Valor</th>
                    <th width="1">Quantidade</th>
                    <th>Categoria</th>
                    <th width="1"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="addPanel.show" class="bg-gray-light">
                    <td>
                        <button type="button" class="btn btn-outline-gray-medium text-dark bg-white"
                                @click="pictureAdd()">
                            <i class="fas fa-camera fa-fw"></i>
                        </button>
                    </td>
                    <td><input type="text" class="form-control"
                               :class="{'is-invalid': addPanel.errors.name  }"
                               @change="validateAdd('name')"
                               v-model="addPanel.product.name"></td>
                    <td><input type="text" class="form-control"
                               :class="{'is-invalid': addPanel.errors.unit_name }"
                               @change="validateAdd('unit_name')"
                               v-model="addPanel.product.unit_name"></td>
                    <td><input type="number" min="0" step="1" class="form-control" v-model="addPanel.product.value">
                    </td>
                    <td><input type="number" min="0" step="1" class="form-control" v-model="addPanel.product.amount">
                    </td>
                    <td>
                        <select class="form-control" v-model="addPanel.product.sys_product_category_id">
                            <option v-for="item in categories" v-text="item.name" :value="item.id"></option>
                        </select>
                    </td>
                    <td class="text-nowrap">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary" @click="add()"
                                    :disabled="loading">
                                <i class="fas fa-save"></i>
                            </button>
                            <button type="button" class="btn btn-danger" @click="clearAdd()"
                                    :disabled="loading">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr v-for="(product, index) in list">
                    <td>
                        <button type="button" class="btn btn-outline-gray-medium text-dark" @click="picture(product)">
                            <i class="fas fa-camera fa-fw"></i>
                        </button>
                    </td>
                    <td><input type="text" class="form-control"
                               :class="{'is-invalid': product.errors.name  }"
                               @change="validateUpdate(product, 'name')"
                               v-model="product.name"></td>
                    <td><input type="text" class="form-control"
                               :class="{'is-invalid': product.errors.unit_name  }"
                               @change="validateUpdate(product, 'unit_name')"
                               v-model="product.unit_name"></td>
                    <td><input type="number" min="0" step="1" class="form-control" v-model="product.value"></td>
                    <td><input type="number" min="0" step="1" class="form-control" v-model="product.amount"></td>
                    <td>
                        <select class="form-control" v-model="product.sys_product_category_id">
                            <option v-for="item in categories" v-text="item.name" :value="item.id"></option>
                        </select>
                    </td>
                    <td class="text-nowrap">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary" @click="save(product)"
                                    :disabled="loading">
                                <i class="fas fa-save"></i>
                            </button>
                            <button type="button" class="btn btn-danger" @click="del(product, index)"
                                    :disabled="loading">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal fade" :id="'modal_picture_' + product.id" tabindex="-1" aria-hidden="true"
         v-for="(product, index) in list">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-camera fa-fw"></i> Foto
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img :src="product.picture" class="img-fluid" v-if="product.picture">
                </div>
                <div class="bg-gray-light p-2 text-center">
                    <input type="file" :id="'file_picture_' + product.id" @change="pictureChange($event, product)">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" @click="save(product)">Fechar e Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_picture_add" tabindex="-1" aria-hidden="true"
         v-for="(product, index) in list">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-camera fa-fw"></i> Foto
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img :src="addPanel.product.picture" class="img-fluid" v-if="addPanel.product.picture">
                </div>
                <div class="bg-gray-light p-2 text-center">
                    <input type="file" id="file_picture_add" @change="pictureChange($event, addPanel.product)">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" @click="add()">Fechar e Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new Vue({
        el: '#product-categories',
        data: {
            api: '<?= site_url('admin/api/produtos') ?>/',
            headers: {'X-CSRF-TOKEN': '<?= csrf_hash() ?>'},
            list: [],
            product: null,
            category: null,
            categories: [],
            loading: false,
            error: null,
            addPanel: {
                show: false,
                pristine: true,
                product: {},
                errors: {
                    name: false,
                    unit_name: false
                }
            }
        },
        created: function () {
            this.fetchCategories();
        },
        methods: {
            validateAdd: function (element) {
                this.addPanel.errors[element] = !this.addPanel.product[element].length;
            },
            validateUpdate: function (product, element) {
                product.errors[element] = !product[element].length;
            },
            showAdd: function () {
                this.clearAdd();
                this.addPanel.show = true;
            },
            clearAdd: function () {
                this.addPanel.show = false;
                this.addPanel.pristine = true;
                this.addPanel.product = {
                    id: null,
                    sys_product_category_id: this.category,
                    picture: null,
                    name: null,
                    unit_name: null,
                    value: 0,
                    amount: 0,
                };
                this.addPanel.errors = {
                    name: false,
                    unit_name: false
                };
                $('#file_picture_add').val('');
            },
            pictureAdd: function () {
                $('#modal_picture_add').modal('show');
            },
            picture: function (product) {
                $('#modal_picture_' + product.id).modal('show');
            },
            pictureChange: function (event, product) {
                if (event.target.files.length) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        product.picture = e.target.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            },
            save: function (product) {
                if (!product.name || !product.name.length) return;
                if (!product.unit_name || !product.unit_name.length) return;
                $('#modal_picture_' + product.id).modal('hide');
                this.loading = true;
                const data = new FormData();
                const picture = $('#file_picture_' + product.id);
                data.append('id', product.id);
                data.append('sys_product_category_id', product.sys_product_category_id);
                data.append('name', product.name);
                data.append('unit_name', product.unit_name);
                data.append('value', product.value);
                data.append('amount', product.amount);
                if (picture.length) data.append('picture', picture[0].files[0]);

                $.ajax({
                    url: this.api + product.id,
                    type: 'POST',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: this.headers
                }).always(() => {
                    picture.val('');
                    this.fetch();
                });
            },
            del: function (product, index) {
                if (window.confirm("Tem certeza que deseja remover?")) {
                    this.list.splice(index, 1);
                    this.loading = true;
                    this.error = null;
                    $.ajax({
                        url: this.api + product.id,
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
                const product = this.addPanel.product;
                if (!product.name || !product.name.length) {
                    this.addPanel.errors.name = true;
                    return;
                }
                if (!product.unit_name || !product.unit_name.length) {
                    this.addPanel.errors.unit_name = true;
                    return;
                }
                $('#modal_picture_add').modal('hide');
                this.loading = true;
                const data = new FormData();
                data.append('id', product.id);
                data.append('sys_product_category_id', product.sys_product_category_id);
                data.append('name', product.name);
                data.append('unit_name', product.unit_name);
                data.append('value', product.value);
                data.append('amount', product.amount);
                const picture = $('#file_picture_add');
                if (picture.length) data.append('picture', picture[0].files[0]);

                $.ajax({
                    url: this.api,
                    type: 'POST',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: this.headers
                }).always(() => {
                    picture.val('');
                    this.fetch();
                });
            },
            fetch: function () {
                this.loading = true;
                $.get(this.api + '?category=' + this.category, (data) => {
                    this.list = data.map(product => {
                       product.errors = { name: false, unit_name: false};
                       return product;
                    });
                }).always(() => {
                    this.loading = false;
                    this.clearAdd();
                });
            },
            fetchCategories: function () {
                this.loading = true;
                $.get('<?= site_url('admin/api/produto/categorias') ?>', (data) => {
                    this.categories = data;
                    if (this.categories.length) {
                        this.category = this.categories[0].id;
                        this.fetch();
                    }
                }).always(() => {
                    this.loading = false;
                });
            }
        }
    });
</script>
<?= view('Admin/Partials/footer') ?>
