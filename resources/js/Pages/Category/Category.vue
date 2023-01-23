<template>
  <layout>
    <Head title="Category" />
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <Link href="/category" class="m-0">Category</Link>
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
                <h3 class="card-title">Category Data</h3>
                <div class="row">
                  <div class="col-md-10"></div>
                  <div class="col-md-2">
                    <div class="card-tools float-right">
                      <div class="input-group input-group-sm">
                        <Link as="button" :href="`/category/create`" class="btn btn-sm btn-success">
                        Create Category
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Category Name</th>
                      <th>Duration</th>
                      <th>Description</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="category in categories" :key="category.id" v-on:click="gotoEdit(category.id)"
                      class="clickable-row">
                      <td>
                        <span v-text="category.category_name"></span>
                      </td>
                      <td>
                        <span class="text-center" v-text="category.duration + ' Hours' "></span>
                      </td>
                      <td>
                        <span v-text="category.description"></span>
                      </td>
                      <td>
                        Rp. <span v-text="Number(category.price).toLocaleString('de-DE')"></span>
                      </td>
                      <td class="text-right">
                        <i class="nav-icon fas fa-arrow-right"></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </layout>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Layout from "../../Shared/Layout.vue";

export default {
  components: {
    Layout,
    Head,
    Link,
  },
  props: {
    categories: Array,
    flash: Object,
  },
  methods: {
    gotoEdit(id) {
      this.$inertia.get("/category/" + id + "/edit");
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