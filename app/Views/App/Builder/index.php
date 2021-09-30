<?php
/**
 * @var \App\Entities\SysPage $page
 */

echo partial_view('header');
vendor_js('vue/vue');
?>
<section id="Builder" class="container py-5">
    <header class="d-flex flex-column flex-sm-row align-items-center">
        <h2 class="text-secondary text-uppercase font-weight-bold mr-sm-4"><?= $page->title ?></h2>
        <h6 class="text-uppercase">Compra mínima
            <strong>$<?= number_format((double)sys_config()->variables['compra_minima_valor']->value, 0) ?></strong>
        </h6>
        <h2 class="text-uppercase font-weight-bold ml-sm-auto">{{cart.value | toCurrency}}<sup>*</sup></h2>
    </header>
    <section v-for="category in categories">
        <header class="mb-3 mt-5 mb-sm-5">
            <h4 class="text-primary font-weight-bold text-uppercase" v-text="category.name"></h4>
        </header>
        <div class="row font-weight-bold text-gray d-none d-sm-flex py-3">
            <div class="col-sm-4">
                Producto
            </div>
            <div class="col-sm-2">
                Unidad
            </div>
            <div class="col-sm-2">
                Valor
            </div>
            <div class="col-sm-2">
                Cantidad
            </div>
            <div class="col-sm-2 text-sm-right">
                Valor Total
            </div>
        </div>
        <div class="product" v-for="product in cart.products" v-if="product.sys_product_category_id == category.id">
            <div class="picture rounded border" @click="togglePic(product)"
                 :class="{'d-none': !product.showPic, 'd-block': product.showPic}"
                 :style="{backgroundImage: pic(product)}">
            </div>
            <div class="row align-items-center py-3 py-sm-1" :class="{'font-weight-bold': product.inCart > 0 }">
                <div class="col-8 col-sm-4 text-uppercase cursor-pointer"
                     @click="togglePic(product)"><i class="far fa-image d-inline d-sm-none"></i> {{product.name}}
                </div>
                <div class="col-3 col-sm-2 text-right text-sm-left text-nowrap">
                    <span class="d-inline d-sm-none">{{product.value | toCurrency}} / </span>
                    {{product.unit_name}}
                </div>
                <div class="d-none d-sm-block col-sm-2">
                    {{product.value | toCurrency}}
                </div>
                <div class="col-8 col-sm-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-gray-light text-gray" type="button" @click="del(product)"
                                    :disabled="loading || product.inCart == 0">
                                <i class="fas fa-minus fa-fw"></i>
                            </button>
                        </div>
                        <input type="number" class="form-control text-center" min="0" :max="product.amount"
                               :value="product.inCart">
                        <div class="input-group-append">
                            <button class="btn btn-gray-light text-gray" type="button" @click="add(product)"
                                    :disabled="loading || product.inCart >= product.amount">
                                <i class="fas fa-plus fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-sm-2 text-right">
                    {{product.valueCart | toCurrency}}
                </div>
            </div>
        </div>
    </section>
    <footer class="text-center my-5">
        <small class="d-block my-3">
            * ENTREGA A DOMICILIO
            <strong>$<?= number_format((double)sys_config()->variables['entrega_valor']->value, 0) ?></strong>
        </small>
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <button type="button" class="btn btn-secondary btn-block" :disabled="!cart.canPurchase"
                        @click="checkout()">
                    <small class="font-weight-bold">FINALIZAR MI PEDIDO</small>
                </button>
            </div>
        </div>
        <small class="d-block text-danger font-weight-bold my-3 cursor-pointer" @click="clear()">CANCELAR</small>
    </footer>
</section>
<script>

    Vue.filter('toCurrency', function (value) {
        value = parseFloat(value);
        if (typeof value !== "number") {
            return value;
        }
        var formatter = new Intl.NumberFormat('es-AR', {
            style: 'currency',
            currency: 'ARS',
            minimumFractionDigits: 0
        });
        return formatter.format(value);
    });

    new Vue({
        el: '#App',
        data: {
            headers: {'X-CSRF-TOKEN': '<?= csrf_hash() ?>'},
            categories: [],
            cart: [],
            loading: false
        },
        created: function () {
            this.fetchCategories();
        },
        methods: {
            pic: function (product) {
                return "url('<?= site_url("assets/img/uploads") ?>/" + product.picture + "')"
            },
            togglePic: function (product) {
                for (let i in this.cart.products) {
                    if (this.cart.products[i].id === product.id) continue;
                    this.cart.products[i].showPic = false;
                }
                product.showPic = !product.showPic;
            },
            checkout: function () {
                window.location.href = '<?= site_url('carrito') ?>';
            },
            add: function (product) {
                this.loading = true;
                $.get('<?= site_url('api/cart/add') ?>/' + product.id).always(() => {
                    this.loading = false;
                    this.fetchCart();
                }).fail((http) => {
                    if (http.status === 401) this.failUnauthorized();
                    console.error(http);
                });
            },
            del: function (product) {
                this.loading = true;
                $.get('<?= site_url('api/cart/del') ?>/' + product.id).always(() => {
                    this.loading = false;
                    this.fetchCart();
                }).fail((http) => {
                    if (http.status === 401) this.failUnauthorized();
                    console.error(http);
                });
            },
            clear: function () {
                if (window.confirm("¿Estas seguro que quieres cancelar?")) {
                    this.loading = true;
                    $.get('<?= site_url('api/cart/clear') ?>').always(() => {
                        this.loading = false;
                        this.fetchCart();
                    }).fail((http) => {
                        if (http.status === 401) this.failUnauthorized();
                        console.error(http);
                    });
                }
            },
            fetchCategories: function () {
                this.loading = true;
                $.get('<?= site_url('api/categories') ?>', (data) => {
                    this.categories = data;
                    if (this.categories.length) {
                        this.fetchCart();
                    }
                }).always(() => {
                    this.loading = false;
                }).fail((http) => {
                    if (http.status === 401) this.failUnauthorized();
                    console.error(http);
                });
            },
            fetchCart: function () {
                this.loading = true;
                $.get('<?= site_url('api/cart') ?>', (data) => {
                    this.cart = data;
                }).always(() => {
                    this.loading = false;
                }).fail((http) => {
                    if (http.status === 401) this.failUnauthorized();
                    console.error(http);
                });
            },
            failUnauthorized: function () {
                window.location.reload();
            }
        }
    });
</script>
<?= partial_view('footer') ?>
