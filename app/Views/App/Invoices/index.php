<?php
/**
 * @var \App\Entities\SysPage $page
 */

echo partial_view('header');
vendor_js('vue/vue');
?>
<section id="Invoices" class="container py-5">
    <header class="d-flex flex-row align-items-center mb-3">
        <h2 class="text-secondary text-uppercase font-weight-bold mb-0"><?= $page->title ?> <i
                    v-if="loading && !invoices.length" class="fas fa-spinner fa-pulse text-primary"></i></h2>
        <nav class="ml-auto" v-if="pages > 1">
            <ul class="pagination justify-content-center mb-0">
                <li class="page-item" :class="{'disabled': page == 1}" @click="fetch(page-1)">
                    <a class="page-link" :class="{'bg-gray-light': page == 1}" href="#" tabindex="-1"
                       aria-disabled="true">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
                <li class="page-item d-none d-sm-inline" v-for="p in pages" :key="p" :class="{'active': p == page}">
                    <a class="page-link" href="#" @click="fetch(p)">{{p}}</a>
                </li>
                <li class="page-item" :class="{'disabled': page == pages}" @click="fetch(page+1)">
                    <a class="page-link" :class="{'bg-gray-light': page == pages}" href="#">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <section>
        <div class="row font-weight-bold text-gray d-none d-sm-flex py-3">
            <div class="col-sm-4">
                Fecha
            </div>
            <div class="col-sm-2">
                Situación
            </div>
            <div class="col-sm-2 text-center">
                Cantidad
            </div>
            <div class="col-sm-1 text-right">
                Entrega
            </div>
            <div class="col-sm-1 text-right text-nowrap">
                Sub Total
            </div>
            <div class="col-sm-2 text-sm-right text-nowrap">
                Valor Total
            </div>
        </div>
        <div class="invoice" v-for="invoice in invoices"
             :class="{'active': invoice.id == invoice_id && products_show  }">
            <div class="row cursor-pointer my-sm-4"
                 :class="{'font-weight-bold': invoice.id == invoice_id && products_show  }"
                 @click="fetchProducts(invoice.id)">
                <div class="col-12 col-sm-4 text-nowrap">
                    {{invoice.date | toDate}}
                </div>
                <div class="col-8 col-sm-2">
                    {{ getStatus(invoice.sys_product_invoice_status_id) }}
                </div>
                <div class="d-none d-sm-block col-sm-2 text-center">
                    {{invoice.amount}}
                </div>
                <div class="d-none d-sm-block col-sm-1 text-right text-nowrap">
                    {{invoice.delivery_cost | toCurrency}}
                </div>
                <div class="d-none d-sm-block col-sm-1 text-right text-nowrap">
                    {{invoice.subtotal | toCurrency}}
                </div>
                <div class="col-4 col-sm-2 text-right text-nowrap">
                    {{invoice.total | toCurrency}}
                </div>
            </div>
            <div class="bg-gray-light px-3 py-0 pb-sm-3" v-if="invoice.id == invoice_id && products_show">
                <section v-for="category in product_categories">
                    <header class="py-3">
                        <h4 class="text-primary font-weight-bold text-uppercase m-0" v-text="category.name"></h4>
                    </header>
                    <div class="row font-weight-bold text-gray d-none d-sm-flex pb-3">
                        <div class="col-sm-4">Producto</div>
                        <div class="col-sm-2">Unidad</div>
                        <div class="col-sm-2">Valor</div>
                        <div class="col-sm-2 text-center">Cantidad</div>
                        <div class="col-sm-2 text-sm-right">Valor Total</div>
                    </div>
                    <div class="product" v-for="product in products"
                         v-if="product.sys_product_category_id == category.id">
                        <div class="picture rounded border" @click="togglePic(product)"
                             :class="{'d-none': !product.showPic, 'd-block': product.showPic}"
                             :style="{backgroundImage: pic(product)}">
                        </div>
                        <div class="row align-items-center pb-3 py-sm-1"
                             :class="{'font-weight-bold': product.inCart > 0 }">
                            <div class="col-12 col-sm-4 text-uppercase cursor-pointer"
                                 @click="togglePic(product)"><i class="far fa-image d-inline d-sm-none"></i>
                                {{product.name}}
                            </div>
                            <div class="d-none d-sm-block col-sm-2 text-right text-sm-left text-nowrap">
                                {{product.unit_name}}
                            </div>
                            <div class="d-none d-sm-block col-sm-2">
                                {{product.value | toCurrency}}
                            </div>
                            <div class="col-8 col-sm-2 text-left text-sm-center">
                                {{product.amount}} <span class="d-inline d-sm-none">x {{product.unit_name}}</span>
                            </div>
                            <div class="col-4 col-sm-2 text-right">
                                {{product.value * product.amount | toCurrency}}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="bg-gray-light text-center my-3 py-3"
                 v-if="invoice.id == invoice_id && !products.length && !loading">
                No se encontraron productos
            </div>
            <div class="bg-gray-light text-center my-3 py-3" v-if="invoice.id == invoice_id && loading">
                <i class="fas fa-spinner fa-pulse"></i>
            </div>
        </div>
    </section>
</section>
<script>
    Vue.filter('toCurrency', function (value) {
        value = parseFloat(value);
        if (typeof value !== "number") {
            return value;
        }
        const formatter = new Intl.NumberFormat('es-AR', {
            style: 'currency',
            currency: 'ARS',
            minimumFractionDigits: 0
        });
        return formatter.format(value);
    });

    Vue.filter('toDate', function (value) {
        const formatter = new Intl.DateTimeFormat('es-AR', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
        const string = formatter.format(new Date(value));
        return string.charAt(0).toUpperCase() + string.slice(1);
    });

    new Vue({
        el: '#App',
        data: {
            headers: {'X-CSRF-TOKEN': '<?= csrf_hash() ?>'},
            categories: {},
            status: {},
            invoices: [],
            products: [],
            products_show: false,
            invoice_id: null,
            loading: false,
            page: 0,
            pages: 0,
            total: 0
        },
        created: function () {
            this.fetchStatus();
            this.fetchCategories();
            this.fetchPages();
        },
        computed: {
            product_categories: function () {
                let cats = {};
                for (let i in this.products) {
                    cats[this.products[i].sys_product_category_id] = {
                        id: this.products[i].sys_product_category_id,
                        name: this.categories[this.products[i].sys_product_category_id],
                    };
                }
                cats = Object.values(cats);
                cats.sort((a, b) => a.name.localeCompare(b.name));
                return cats;
            }
        },
        methods: {
            pic: function (product) {
                return "url('<?= site_url("assets/img/uploads") ?>/" + product.picture + "')"
            },
            togglePic: function (product) {
                for (let i in this.products) {
                    if (this.products[i].id === product.id) continue;
                    this.products[i].showPic = false;
                }
                product.showPic = !product.showPic;
            },
            getCategory: function (id) {
                return this.categories[id];
            },
            getStatus: function (id) {
                return this.status[id];
            },
            fetch: function (page) {
                if (page < 1 || page > this.pages || this.page === page) return;
                this.page = page;
                this.invoice_id = null;
                this.products = [];
                this.loading = true;
                $.get('<?= site_url('api/invoices') ?>/' + page, (data) => {
                    this.invoices = data;
                }).always(() => {
                    this.loading = false;
                }).fail((http) => {
                    if (http.status === 401) this.failUnauthorized();
                    console.error(http);
                });
            },
            fetchPages: function () {
                $.get('<?= site_url('api/invoice/pages') ?>', (data) => {
                    this.pages = data.pages;
                    this.total = data.total;
                    this.fetch(1);
                }).fail((http) => {
                    if (http.status === 401) this.failUnauthorized();
                    console.error(http);
                });
            },
            fetchCategories: function () {
                $.get('<?= site_url('api/invoice/categories') ?>', (data) => {
                    this.categories = data;
                });
            },
            fetchStatus: function () {
                $.get('<?= site_url('api/invoice/status') ?>', (data) => {
                    this.status = data;
                }).fail((http) => {
                    if (http.status === 401) this.failUnauthorized();
                    console.error(http);
                });
            },
            fetchProducts: function (id) {
                if (this.invoice_id === id) {
                    this.products_show = !this.products_show;
                    return;
                }
                this.invoice_id = id;
                this.products = [];
                this.loading = true;
                this.products_show = false;
                this.product_categories = {};
                $.get('<?= site_url('api/invoice/products') ?>/' + id, (data) => {
                    this.products = data;
                    this.products_show = true;
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
