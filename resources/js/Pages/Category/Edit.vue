<template>
  <layout>

    <Head title="Create Category" />
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <Link href="" class="m-0">Category</Link>
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
                <h3 class="card-title">Create Category</h3>
              </div>

              <form @submit.prevent="update">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleCategoryName">Category Name</label>
                    <input id="category_name" v-model="form.category_name" type="text" class="form-control"
                      :class="{ 'is-invalid': categoryNameError }" placeholder="Category Name" />
                    <span v-if="errors.category_name" class="text-danger">{{
                      errors.category_name
                    }}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleDuration">Duration</label>
                    <div class="form-group input-group">
                      <input id="duration" v-model="form.duration" type="number" class="form-control"
                        :class="{ 'is-invalid': durationError }" placeholder="Duration" />
                      <div class="input-group-append">
                        <span class="input-group-text">
                          Hours
                        </span>
                      </div>
                    </div>
                    <span v-if="errors.duration" class="text-danger">{{
                      errors.duration
                    }}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleDescription">Description</label>
                    <textarea id="description" v-model="form.description" type="text" class="form-control"
                      :class="{ 'is-invalid': descriptionError }" placeholder="Description"></textarea>
                    <span v-if="errors.description" class="text-danger">{{
                      errors.description
                    }}</span>
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <div class="form-group input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                      </div>
                      <input id="price" v-model="form.price" type="number" class="form-control"
                        :class="{ 'is-invalid': priceError }" placeholder="Enter price" />
                    </div>
                    <span v-if="errors.price" class="text-danger">{{
                      errors.price
                    }}</span>
                  </div>
                </div>

                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-6">
                      <button type="button" class="btn text-red" @click="deleteCategory">
                        Delete Category
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
        category_name: this.category.category_name,
        duration: this.category.duration,
        description: this.category.description,
        price: this.category.price,
      },
    };
  },
  props: {
    errors: Object,
    category: Object,
    flash: Object,
  },
  methods: {
    update() {
      this.$inertia.put("/category/" + this.category.id, this.form);
    },
    deleteCategory() {
      this.swalConfirm(() => this.$inertia.delete("/category/" + this.category.id));
    },
  },
  computed: {
    categoryNameError() {
      return !!this.errors.category_name;
    },
    durationError() {
      return !!this.errors.duration;
    },
    descriptionError() {
      return !!this.errors.description;
    },
    priceError() {
      return !!this.errors.price;
    },
  },
};
</script>