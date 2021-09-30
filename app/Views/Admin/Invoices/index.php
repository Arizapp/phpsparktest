<?php
/**
 * @var SysConfig $config
 */

use App\Entities\SysConfig;
use App\Libraries\Admin\Auth;

echo view('Admin/Partials/header', ['identifier' => $view ?? '']);
vendor_js('vue/vue');

$isSuper = Auth::getSharedInstance()->isSuper();
?>
  <div class="container" id="Pedidos">
    <div class="card border-bottom-primary shadow mb-3">
      <div class="card-header text-white bg-primary">
        <a target="_blank" class="btn btn-outline-white float-right"
           :href="'<?= site_url('admin/pedidos/print') ?>/'+ date.current ">
          IMPRIMIR <i class="fa fas fa-print"></i>
        </a>
        <a target="_blank" class="btn btn-outline-white float-right mr-1" @click="sync()">
          <i class="fas fa-sync"></i>
        </a>
        <h4 class="m-0 pt-1"><i class="fas fa-receipt"></i> Pedidos</h4>
      </div>
      <div class="bg-gray-light py-2 px-3">
        <div class="row align-items-center">
          <div class="col-2 text-left">
            <button type="button" class="btn btn-primary" @click="prev()" :disabled="loading">
              <i class="fas fa-fw fa-arrow-left cursor-pointer"></i>
            </button>
          </div>
          <div class="col-8 text-center">
            <div class="input-group">
              <input type="date" class="form-control" id="date-start" v-model="date.start"
                     @change="fetchByDay()" :disabled="loading">
              <input type="date" class="form-control bg-white" id="date-end" readonly v-model="date.end">
            </div>
          </div>
          <div class="col-2 text-right">
            <button type="button" class="btn btn-primary" @click="next()" :disabled="loading">
              <i class="fas fa-fw fa-arrow-right cursor-pointer"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row font-weight-bold text-gray d-none d-sm-flex">
          <div class="col-5">Cliente</div>
          <div class="col-2">Fecha</div>
          <div class="col-2">Situacíon</div>
          <div class="col-1 text-nowrap text-right">Entrega</div>
          <div class="col-1 text-nowrap text-right">Valor</div>
          <div class="col-1 text-nowrap text-right">Total</div>
        </div>
        <div class="invoice" v-for="invoice in invoices"
             :class="{'active': invoice.id == invoice_id && products_show  }">
          <div class="row my-sm-4"
               :class="{
                            'font-weight-bold': invoice.id == invoice_id && products_show,
                            'text-secondary': invoice.sys_product_invoice_status_id == 5
                         }">
            <div class="col-5 text-nowrap cursor-pointer" @click="fetchProducts(invoice.id)">
              <i class="fas fa-fw"
                 :class="{ 'fa-caret-down': invoice.id == invoice_id && products_show, 'fa-caret-right': invoice.id != invoice_id || !products_show }"></i>
              {{invoice.sys_customer_id}}
            </div>
            <div class="col-2">
              {{invoice.date | toDate}}
            </div>
            <div class="col-2">
              <div class="dropdown" v-if="invoice.sys_product_invoice_status_id != 5">
                <div class="dropdown-toggle cursor-pointer" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false">{{ getStatus(invoice.sys_product_invoice_status_id) }}
                </div>
                <div class="dropdown-menu">
                  <div class="dropdown-item cursor-pointer" v-for="(sName, sId) in status"
                       @click="changeStatus(invoice, sId)"
                       :class="{'active': sId == invoice.sys_product_invoice_status_id}">{{sName}}
                  </div>
                </div>
              </div>
              <div v-if="invoice.sys_product_invoice_status_id == 5">{{ getStatus(invoice.sys_product_invoice_status_id)
                }}
              </div>
            </div>
            <div class="col-1 text-nowrap text-right">
              {{invoice.delivery_cost | toCurrency}}
            </div>
            <div class="col-1 text-nowrap text-right">
              {{invoice.subtotal | toCurrency}}
            </div>
            <div class="col-1 text-nowrap text-right">
              {{invoice.total | toCurrency}}
            </div>
          </div>
          <div class="bg-gray-light px-3 py-3 pb-sm-3" v-if="invoice.id == invoice_id && products_show">
            <div class="row font-weight-bold text-gray d-none d-sm-flex pb-3">
              <div class="col-sm-4">Producto</div>
              <div class="col-sm-2">Unidad</div>
              <div class="col-sm-2">Valor</div>
              <div class="col-sm-2 text-center">Cantidad</div>
              <div class="col-sm-2 text-sm-right">Valor Total</div>
            </div>
            <div class="product" v-for="product in products">
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
                  {{product.amount}} <span class="d-inline d-sm-none">x
                                        {{product.unit_name}}</span>
                </div>
                <div class="col-4 col-sm-2 text-right">
                  {{product.value * product.amount | toCurrency}}
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-light text-center my-3 py-3"
               v-if="invoice.id == invoice_id && !products.length && !loading">
            No se encontraron productos
          </div>
          <div class="bg-gray-light text-center my-3 py-3" v-if="invoice.id == invoice_id && loading">
            <i class="fas fa-spinner fa-pulse"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
      <?php
      $current = date('W-Y');
      $prev = date('W-Y', strtotime('-1 week'));
      $next = date('W-Y', strtotime('+1 week'));
      $start = (new DateTime())->setISODate(date('Y'), date('W'), 0)->format('Y-m-d');
      $end = date('Y-m-d', strtotime($start . '+6 days'));
      ?>


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
          const formatter = new Intl.DateTimeFormat('es-AR');
          const string = formatter.format(new Date(value));
          return string.charAt(0).toUpperCase() + string.slice(1);
      });

      new Vue({
          el: '#Pedidos',
          data: {
              loading: false,
              date: {
                  current: '<?= $current ?>',
                  prev: '<?= $prev ?>',
                  next: '<?= $next ?>',
                  start: '<?= $start ?>',
                  end: '<?= $end ?>',
              },
              invoices: [],
              status: {},
              products: [],
              products_show: false,
              invoice_id: null,
          },
          created: function () {
              this.fetchStatus();
              this.fetch(this.date.current);
          },
          methods: {
              sync: function () {
                  this.fetch(this.date.current);
              },
              fetch: function (week) {
                  this.loading = true;
                  $.get('<?= site_url('admin/api/pedidos') ?>?week=' + week, (data) => {
                      this.date = data.date;
                      this.invoices = data.invoices;
                  }).always(() => {
                      this.loading = false;
                  });
              },
              fetchByDay: function () {
                  this.loading = true;
                  $.get('<?= site_url('admin/api/pedidos') ?>?day=' + this.date.start, (data) => {
                      this.date = data.date;
                      this.invoices = data.invoices;
                  }).always(() => {
                      this.loading = false;
                  });
              },
              prev: function () {
                  this.fetch(this.date.prev);
              },
              next: function () {
                  this.fetch(this.date.next);
              },
              fetchStatus: function () {
                  $.get('<?= site_url('api/invoice/status') ?>', (data) => {
                      this.status = data;
                  });
              },
              getStatus: function (id) {
                  return this.status[id];
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
              },
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
              changeStatus: function (invoice, id) {
                  if (id == 5 && !window.confirm('Al cancelar los productos se devolverán a stock. ¿Está seguro?')) return;
                  $.get('<?= site_url('admin/api/pedidos/status') ?>/' + invoice.id + '/' + id, (data) => {
                      if (data) {
                          invoice.sys_product_invoice_status_id = id;
                      }
                  }).fail((http) => {
                      if (http.status === 401) this.failUnauthorized();
                      console.error(http);
                  });
              }
          }
      });
  </script>
<?= view('Admin/Partials/footer') ?>