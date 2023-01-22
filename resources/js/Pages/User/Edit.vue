<template>
  <layout>

    <Head title="Create Employee" />
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <Link href="" class="m-0">Employee</Link>
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
                <h3 class="card-title">Create Employee</h3>
              </div>

              <form @submit.prevent="update">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleName">Name</label>
                    <input id="name" v-model="form.name" type="text" class="form-control"
                      :class="{ 'is-invalid': nameError }" placeholder="Name" />
                    <span v-if="errors.name" class="text-danger">{{
                      errors.name
                    }}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleBranchID">Branch</label>
                    <select id="branch_id" class="form-control custom-select" v-model="form.branch_id">
                      <option v-for="branch in branchs" :key="branch.id" :value="branch.id">
                        {{ branch.branch_name }}
                      </option>
                    </select>
                    <span v-if="errors.branch_id" class="text-danger">{{
                      errors.branch_id
                    }}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleEmail">Email</label>
                    <input id="email" v-model="form.email" type="email" class="form-control"
                      :class="{ 'is-invalid': emailError }" placeholder="Email" />
                    <span v-if="errors.email" class="text-danger">{{
                      errors.email
                    }}</span>
                  </div>
                  <div class="form-group">
                    <label for="examplePassword">Password</label>
                    <input id="password" v-model="form.password" type="password" class="form-control"
                      :class="{ 'is-invalid': passwordError }" placeholder="Password" />
                    <span v-if="errors.password" class="text-danger">{{
                      errors.password
                    }}</span>
                  </div>
                </div>

                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-6">
                      <button type="button" class="btn text-red" @click="deleteUser">
                        Delete Employee
                      </button>
                    </div>
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
        name: this.user.name,
        email: this.user.email,
        password: this.user.password,
        branch_id: this.user.branch_id,
      },
    };
  },
  props: {
    user: Object,
    errors: Object,
    branchs: Array,
    flash: Object,
  },
  methods: {
    update() {
      this.$inertia.put("/user/" + this.user.id, this.form);
    },
    showAlert() {
      this.$swal("Hello Vue world!!!");
    },
    deleteUser() {
      this.swalConfirm(() => this.$inertia.delete("/user/" + this.user.id));
    }
  },
  computed: {
    nameError() {
      return !!this.errors.name;
    },
    emailError() {
      return !!this.errors.email;
    },
    passwordError() {
      return !!this.errors.password;
    },
    branch_idError() {
      return !!this.errors.branch_id;
    },
  },
};
</script>