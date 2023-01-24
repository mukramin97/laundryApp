<template>
  <layout>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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
          <div class="col-lg-2 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ totalOrder }}</h3>
                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ totalPayment }}</h3>
                <p>Total Payment</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{
                  totalGross.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                  })
                }}</h3>
                <p>Gross Income</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{
                  estimatedActual.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                  })
                }}</h3>
                <p>Estimated vs Actual Paid</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h6>Filter</h6>
                <div class="row">
                  <div class="col-5">
                    <div class="form-group">
                      <select class="form-control" id="year" v-model="selectedYear" @change="fetchData">
                        <option value=2021>2021</option>
                        <option value=2022>2022</option>
                        <option value=2023>2023</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-7">
                    <div class="form-group">
                      <select class="form-control" id="month" v-model="selectedMonth" @change="fetchData">
                        <option value=1>January</option>
                        <option value=2>February</option>
                        <option value=3>March</option>
                        <option value=4>April</option>
                        <option value=5>May</option>
                        <option value=6>June</option>
                        <option value=7>July</option>
                        <option value=8>August</option>
                        <option value=9>September</option>
                        <option value=10>October</option>
                        <option value=11>November</option>
                        <option value=12>December</option>
                      </select>
                    </div>
                  </div>
                </div>
                
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
import { Head, Link } from "@inertiajs/inertia-vue3";

import Layout from "../../Shared/Layout.vue";
export default {
  components: {
    Head,
    Link,
    Layout,
  },
  props: {
    totalOrder: Number,
    totalGross: Number,
    totalPayment: Number,
    estimatedActual: Number,
    s_month: Number,
    s_year: Number,
  },
  data: () => ({
    selectedMonth: null,
    selectedYear: null,
    data: {}
  }),
  watch: {
    selectedMonth() {
      // send http request to get data based on selected month
      // update your component data
    },
    selectedYear() {
      // send http request to get data based on selected month
      // update your component data
    }
  },
  methods: {
    fetchData() {
      this.$inertia.visit(`/?month=${this.selectedMonth}&year=${this.selectedYear}`)
    }
  },
  created() {
    if (this.$props.s_month) {
      this.selectedMonth = this.$props.s_month;
    }
    if (this.$props.s_year) {
      this.selectedYear = this.$props.s_year;
    }
  }
};
</script>