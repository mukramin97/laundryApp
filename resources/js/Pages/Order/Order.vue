<template>
  <layout>

    <Head title="Order" />
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <Link href="/order" class="m-0">Order</Link>
            </h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Order Data</h3>
                <div class="row">
                  <div class="col-md-10"></div>
                  <div class="col-md-2">
                    <div class="card-tools float-right">
                      <div class="input-group input-group-sm">
                        <Link as="button" :href="`/order/create`" class="btn btn-sm btn-success">
                        Create Order
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-sm">
                  <thead>
                    <tr>
                      <th>Customer Name</th>
                      <th>Category</th>
                      <th>Weight</th>
                      <th>Total Cost</th>
                      <th>Placed</th>
                      <th>Completed</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="order in orders.data" :key="order.id"
                      v-on:click="gotoEdit(order.id, getCost(order.weight, order.category.price))"
                      class="clickable-row">
                      <td>
                        {{ order.name }}
                      </td>
                      <td>
                        {{ order.category.category_name }}
                      </td>
                      <td>
                        {{ order.weight }} Kg
                      </td>
                      <td>
                        {{
                          getCost(order.weight, order.category.price).toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                          })
                        }}
                      </td>
                      <td>
                        {{ formatDate(order.date_placed) }}
                      </td>
                      <td>
                        {{ formatDate(order.date_completed) }}
                      </td>
                      <td>
                        {{ order.status }}
                      </td>

                      <td class="text-right">
                        <i class="nav-icon fas fa-arrow-right"></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- Pagination -->
            <Pagination :links="orders.links" />
          </div>
        </div>
      </div>
    </section>
  </layout>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Layout from "../../Shared/Layout.vue";
import Pagination from "../../Shared/Pagination.vue";

export default {
  components: {
    Layout,
    Head,
    Link,
    Pagination
  },
  props: {
    orders: Object,
    flash: Object,
  },
  methods: {
    gotoEdit(id, getCost) {
      this.$inertia.get("/order/" + id + "/edit");
    },
    formatDate(date) {
      if (date == null) {
        return ""
      }
      else {
        return moment(date).format('dddd, DD MMM [at] HH:mm')
      }
    },
    getCost(weight, price) {
      return weight * price
    },
  },
  created() {
    if (this.flash && this.flash.success) {
      this.swalMixin('success', this.flash.success)
    }
    if (this.flash && this.flash.error) {
      this.swalMixin('error', this.flash.error)
    }
  },

};
</script>