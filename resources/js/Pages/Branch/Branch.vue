<template>
  <layout>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Branch</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Branch Data</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px">
                    <input
                      type="text"
                      name="table_search"
                      class="form-control float-right"
                      placeholder="Search"
                    />
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
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
                    <tr v-for="branch in formattedBranchs" :key="branch.id">
                      <td>{{ branch.branch_name }}</td>
                      <td>{{ branch.phone_number }}</td>
                      <td>{{ branch.established }}</td>
                      <td class="text-right">
                        <Link :href="`/branch/${branch.id}/edit`">
                          <i class="nav-icon fas fa-arrow-right"></i>
                        </Link>
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
</style>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "../../Shared/Layout.vue";

export default {
  components: {
    Layout,
    Link,
  },
  props: {
    branchs: Array,
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
};
</script>