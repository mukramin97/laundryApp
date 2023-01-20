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
                                    <div class="alert alert-danger" role="alert" v-if="alertError">
                                        {{ flash.error }}
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleName">Customer Name</label>
                                        <input id="name" v-model="form.name" type="text" class="form-control"
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
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleWeight">Weight</label>
                                                <div class="form-group input-group">
                                                    <input id="weight" v-model="form.weight" type="float"
                                                        class="form-control" :class="{ 'is-invalid': weightError }"
                                                        placeholder="Weight" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-weight-hanging"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <span v-if="errors.weight" class="text-danger">
                                                    {{ errors.weight }}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleDatePlaced">Date Placed</label>
                                                <input id="datePlaced" v-model="form.date_placed" type="datetime"
                                                    class="form-control" placeholder="DatePlaced" disabled />
                                                <span v-if="errors.date_placed" class="text-danger">
                                                    {{ errors.date_placed }}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleCost">Cost</label>
                                                <div class="form-group input-group">
                                                    <input id="cost" :value="formatCost(form.cost)" type="float"
                                                        class="form-control" placeholder="Cost" disabled />
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-secondary input-group-text"
                                                            @click="copyValue">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleStatus">Status</label>
                                                <input id="status" v-model="form.status" type="float"
                                                    class="form-control" placeholder="Status" disabled />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleHandledBy">Handled By</label>
                                                <input id="handledBy" v-model="form.user.name" type="float"
                                                    class="form-control" placeholder="Status" disabled />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleAmountPaid">Amount Paid</label>
                                                <div class="form-group input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input id="amount_paid" v-model="form.amount_paid" type="number"
                                                        class="form-control" placeholder="Amount Paid" />
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-secondary input-group-text"
                                                            @click="pasteValue">
                                                            <i class="fas fa-paste"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6" v-if="updateOrderError">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Payment</h3>
                            </div>
                            <form @submit.prevent="updatePayment">
                                <div class="card-body">
                                    <div class="alert alert-warning" role="alert" v-if="updateSuccess">
                                        {{ flash.success }}
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleMethod">Payment Method</label>
                                        <input id="method" v-model="form2.method" type="text" class="form-control"
                                            placeholder="Payment Method" disabled />
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleDatePayment">Date Payment</label>
                                                <input id="date_payment" :value="formatDate(form2.date_payment)"
                                                    type="datetime" class="form-control" placeholder="Payment Method"
                                                    disabled />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleCost">Cost</label>
                                                <div class="form-group input-group">
                                                    <input id="cost" :value="formatCost(form2.cost)" type="float"
                                                        class="form-control" placeholder="Cost" disabled />
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-secondary input-group-text"
                                                            @click="copyValuePayment">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleHandledBy">Handled By</label>
                                                <input id="handledBy" :value="form2.user.name" type="datetime"
                                                    class="form-control" placeholder="Payment Handled by" disabled />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleAmountPaid">Amount Paid</label>
                                                <div class="form-group input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input id="amount_paid" v-model="form2.amount_paid" type="number"
                                                        class="form-control" placeholder="Amount Paid" :class="{ 'is-invalid': amountPaidError }"
                                                        :disabled="checkAuth"
                                                         />
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-secondary input-group-text"
                                                            @click="pasteValuePayment">
                                                            <i class="fas fa-paste"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span v-if="errors.amount_paid" class="text-danger">
                                                    {{ errors.amount_paid }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn btn-primary">
                                                Update
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
                user: this.order.user,
                weight: this.order.weight,
                date_placed: this.order.date_placed,
                status: this.order.status,
                cost: this.order.weight * this.order.category.price,
                amount_paid: null,
            },
            form2: {
                method: this.payment ? this.payment.method : null,
                cost: this.payment ? this.payment.cost : null,
                amount_paid: this.payment ? this.payment.amount_paid : null,
                date_payment: this.payment ? this.payment.date_payment : null,
                user: this.payment ? this.payment.user : null,
            }
        };
    },
    props: {
        errors: Object,
        flash: Object,
        order: Object,
        categories: Array,
        payment: Object,
        auth: Object,
        // current_page: Number,
    },
    methods: {
        update() {
            this.$inertia.put("/order/" + this.order.id, this.form)
        },
        updatePayment() {
            this.$inertia.put("/updatepayment/" + this.payment.id, this.form2)
        },
        formatCost(cost) {
            let costNumber = parseFloat(cost);
            return costNumber.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            })
        },
        formatDate(date) {
            return moment(date).format('DD/MM HH:mm')
        },
        async copyValue() {
            try {
                navigator.clipboard.writeText(this.form.cost);
                console.log('Value copied to clipboard');
            } catch (err) {
                console.error('Failed to copy value: ', err);
            }
        },
        async pasteValue() {
            try {
                const value = await navigator.clipboard.readText();
                this.form.amount_paid = value;
            } catch (err) {
                console.error('Failed to paste value: ', err);
            }
        },
        async copyValuePayment() {
            try {
                navigator.clipboard.writeText(this.form2.cost);
                console.log('Value copied to clipboard');
            } catch (err) {
                console.error('Failed to copy value: ', err);
            }
        },
        async pasteValuePayment() {
            try {
                const value = await navigator.clipboard.readText();
                this.form2.amount_paid = value;
            } catch (err) {
                console.error('Failed to paste value: ', err);
            }
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
        amountPaidError() {
            return !!this.errors.amount_paid;
        },
        alertError() {
            return !!this.flash.error;
        },
        updateSuccess() {
            return !!this.flash.success;
        },
        updateOrderError() {
            return !!this.payment;
        },
        checkAuth() {
            return this.auth.user.id !== this.payment.user.id;
        }
    },
};
</script>