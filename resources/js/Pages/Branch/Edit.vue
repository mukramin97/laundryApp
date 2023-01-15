<template>
  <layout>
    <Head title="Edit Branch" />
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
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Branch</h3>
              </div>

              <form @submit.prevent="update">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleBranchName">Branch Name</label>
                    <input
                      id="branch_name"
                      v-model="form.branch_name"
                      type="text"
                      class="form-control"
                      :class="{ 'is-invalid': branchNameError }"
                      placeholder="Branch Name"
                    />
                    <span v-if="errors.branch_name" class="text-danger">{{
                      errors.branch_name
                    }}</span>
                  </div>
                  <div class="form-group">
                    <label for="examplePhoneNumber">Phone Number</label>
                    <input
                      id="phone_number"
                      v-model="form.phone_number"
                      type="text"
                      class="form-control"
                      :class="{ 'is-invalid': phoneNumberError }"
                      placeholder="Phone Number"
                    />
                    <span v-if="errors.phone_number" class="text-danger">{{
                      errors.phone_number
                    }}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleEstablished">Established</label>
                    <input
                      id="establised"
                      v-model="form.established"
                      type="text"
                      class="form-control"
                      placeholder="Phone Number"
                      readonly
                    />
                  </div>
                </div>

                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6 text-right">
                      <button type="submit" class="btn btn-primary">
                        Submit
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Employee</h3>
                <div class="row">
                  <div class="col-md-10"></div>
                  <div class="col-md-2">
                    <div class="card-tools float-right">
                      <div class="input-group input-group-sm">
                        <Link
                          as="button"
                          :href="
                            `/employee/create/` +
                            branch.id +
                            '/' +
                            branch.branch_name
                          "
                          class="btn btn-sm btn-success"
                        >
                          Create Employee
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="employee in employees"
                      :key="employee.id"
                      v-on:click="gotoEdit(employee.id)"
                      class="clickable-row"
                    >
                      <td>{{ employee.name }}</td>
                      <td>{{ employee.email }}</td>
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
  data() {
    return {
      form: {
        branch_name: this.branch.branch_name,
        phone_number: this.branch.phone_number,
        established: new Date(this.branch.established).toLocaleDateString(
          "en-US",
          { year: "numeric", month: "2-digit", day: "2-digit" }
        ),
      },
    };
  },
  props: {
    errors: Object,
    branch: Object,
    employees: Object,
    flash: Object,
  },
  methods: {
    update() {
      this.$inertia.put("/branch/" + this.branch.id, this.form);
    },
    gotoEdit(id) {
      this.$inertia.get("/employee/" + id + "/edit");
    },
  },
  computed: {
    branchNameError() {
      return !!this.errors.branch_name;
    },
    phoneNumberError() {
      return !!this.errors.phone_number;
    },
  },
  created() {
    if (this.flash && this.flash.success) {
      this.swalMixin('success', this.flash.success)
    }
  },
};
</script>