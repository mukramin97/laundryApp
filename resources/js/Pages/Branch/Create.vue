<template>
  <layout>
    <Head title="Create Branch" />
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
                <h3 class="card-title">Create Branch</h3>
              </div>

              <form @submit.prevent="store">
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
        branch_name: null,
        phone_number: null,
      },
    };
  },
  props: {
    errors: Object,
  },
  methods: {
    store() {
      this.$inertia.post("/branch/store", this.form);
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