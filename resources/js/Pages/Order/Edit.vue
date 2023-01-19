<template>
    <layout>

        <Head title="Create Order" />
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
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create Order</h3>
                            </div>

                            <form @submit.prevent="update">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleName">Order Name</label>
                                        <input id="order_name" v-model="form.name" type="text" class="form-control"
                                            :class="{ 'is-invalid': nameError }" placeholder="Customer Name" />
                                        <span v-if="errors.name" class="text-danger">
                                            {{ errors.name }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleCategoryID">Category</label>

                                        <select id="category_id" class="form-control custom-select"
                                            v-model="form.category_id" :class="{ 'is-invalid': categoryError }">
                                            <option v-for="category in categories" :key="category.id"
                                                :value="category.id">
                                                {{ category.category_name }}
                                            </option>
                                        </select>

                                        <span v-if="errors.category_id" class="text-danger">
                                            {{ errors.category_id }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleWeight">Weight</label>
                                        <input id="weight" v-model="form.weight" type="float" class="form-control"
                                            :class="{ 'is-invalid': weightError }" placeholder="Weight" />
                                        <span v-if="errors.weight" class="text-danger">
                                            {{ errors.weight }}
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleCost">Cost</label>
                                                <input id="cost" :value="formatCost(form.cost)" type="float"
                                                    class="form-control" placeholder="Cost" disabled />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="exampleAmountPaid">Amount Paid</label>

                                            <div class="form-group input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp. </span>
                                                </div>
                                                <input id="amount_paid" v-model="form.amount_paid" type="number"
                                                    class="form-control" placeholder="Amount Paid" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
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
                name: this.order.name,
                category_id: this.order.category_id,
                weight: this.order.weight,
                cost: this.getCost,
                amount_paid: null,
            },
        };
    },
    props: {
        errors: Object,
        flash: Object,
        order: Object,
        categories: Array,
        getCost: Number,
    },
    methods: {
        update() {
            this.$inertia.put("/order/" + this.order.id, this.form);
        },
        formatCost(cost) {
            return cost.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            })
        }
    },
    computed: {
        nameError() {
            return !!this.errors.name;
        },
        categoryError() {
            return !!this.errors.category_id;
        },
        weightError() {
            return !!this.errors.weight;
        },
    },
};
</script>