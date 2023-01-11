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
          <div class="col-md-12">
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
                      :class="{'is-invalid': branchNameError}"
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
                      :class="{'is-invalid': phoneNumberError}"
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
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </layout>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "../../Shared/Layout.vue";

export default {
  components: {
    Layout,
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
  },
  methods: {
    update() {
      this.$inertia.put("/branch/" + this.branch.id, this.form);
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
};
</script>