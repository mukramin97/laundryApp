<template>
  <layout>

    <Head title="Branch" />
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <Link href="/branch" class="m-0">Branch</Link>
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
                <h3 class="card-title">Branch Data</h3>
                <div class="row">
                  <div class="col-md-10"></div>
                  <div class="col-md-2">
                    <div class="card-tools float-right">
                      <div class="input-group input-group-sm">
                        <Link as="button" :href="`/branch/create`" class="btn btn-sm btn-success">
                        Create Branch
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
                      <th>Branch Name</th>
                      <th>Phone Number</th>
                      <th>Date Created</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="branch in formattedBranchs" :key="branch.id" v-on:click="gotoEdit(branch.id)"
                      class="clickable-row">
                      <td>
                        {{ branch.branch_name }}
                      </td>
                      <td>
                        {{ branch.phone_number }}
                      </td>
                      <td>
                        {{ branch.established }}
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

<style>
a {
  color: inherit;
  text-decoration: none;
}

.clickable-row:hover {
  cursor: pointer;
}
</style>

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
    branchs: Array,
    flash: Object,
  },
  computed: {
    formattedBranchs() {
      return this.branchs.map((branch) => {
        return {
          ...branch,
          established: new Date(branch.established).toLocaleDateString(
            "en-US",
            { year: "numeric", month: "2-digit", day: "2-digit" }
          ),
        };
      });
    },
  },
  methods: {
    gotoEdit(id) {
      this.$inertia.get("/branch/" + id + "/edit");
    },
  },
  created() {
    if (this.flash && this.flash.success) {
      this.swalMixin('success', this.flash.success)
    }
  },

};
</script>