<?php
/**
 * @var SysConfig $config
 */

use App\Entities\SysConfig;

echo view('Admin/Partials/header', ['identifier' => $view ?? '']);
vendor_js('vue/vue');

?>
    <div class="container" id="Clientes">
        <div class="card border-bottom-primary shadow mb-3">
            <div class="card-header text-white bg-primary">
                <div class="float-right filter">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="filter">
                        <div class="input-group-append">
                            <button class="btn btn-outline-white" type="button" @click="fetch()">
                                <i class="fas fa-search fa-flip-horizontal"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <h4 class="m-0 pt-1"><i class="fas fa-user-friends"></i> Clientes</h4>
            </div>
            <div class="card-body">
                <div class="row font-weight-bold text-gray d-none d-sm-flex">
                    <div class="col-3">Nombre</div>
                    <div class="col-3">E-mail</div>
                    <div class="col-4">Direción</div>
                    <div class="col-2">Situación</div>
                </div>
                <div class="customer" v-for="customer in customers">
                    <div class="row align-items-center my-sm-4">
                        <div class="col-3 text-nowrap cursor-pointer">
                            {{customer.name}}
                        </div>
                        <div class="col-3">
                            {{customer.email}}
                        </div>
                        <div class="col-4">
                            <input type="text" v-model="customer.address" class="form-control" readonly>
                        </div>
                        <div class="col-2">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn" @click="enable(customer)"
                                        :class="{'btn-primary': customer.disabled == '0', 'btn-gray-light': customer.disabled == '1'}"
                                        :disabled="loading">Activo
                                </button>
                                <button type="button" class="btn" @click="disable(customer)"
                                        :class="{'btn-primary': customer.disabled == '1', 'btn-gray-light': customer.disabled == '0'}"
                                        :disabled="loading">Inactivo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        new Vue({
            el: '#Clientes',
            data: {
                loading: false,
                customers: [],
                filter: '',
            },
            created: function () {
                this.fetch();
            },
            methods: {
                fetch: function () {
                    this.loading = true;
                    $.get('<?= site_url('admin/api/clientes') ?>?filter=' + this.filter, (data) => {
                        this.customers = data;
                    }).always(() => {
                        this.loading = false;
                    });
                },
                enable: function (customer) {
                    this.loading = true;
                    $.get('<?= site_url('admin/api/cliente') ?>/' + customer.id + '/enable')
                        .done(() => {
                            this.fetch();
                        })
                        .always(() => {
                            this.loading = false;
                        });
                },
                disable: function (customer) {
                    this.loading = true;
                    $.get('<?= site_url('admin/api/cliente') ?>/' + customer.id + '/disable')
                        .done(() => {
                            this.fetch();
                        })
                        .always(() => {
                            this.loading = false;
                        });
                }
            }
        });
    </script>
<?= view('Admin/Partials/footer') ?>