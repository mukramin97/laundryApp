<template>

    <body class="login-page" style="min-height: 496.781px;">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Admin Login</b></a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form @submit.prevent="handleLogin">
                        <div class="input-group" :class="{ 'mb-3': !emailError }">
                            <input id="email" v-model="form.email" type="text" class="form-control"
                                :class="{ 'is-invalid': emailError }" placeholder="Email" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <span v-if="errors.email" class="text-danger">{{
                                errors.email
                            }}</span>
                        </div>
                        <div class="input-group" :class="{ 'mb-3': !passwordError }">
                            <input id="password" v-model="form.password" type="password" class="form-control"
                                :class="{ 'is-invalid': passwordError }" placeholder="Password" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <span v-if="errors.password" class="text-danger">{{
                                errors.password
                            }}</span>
                        </div>
                        <div class="alert alert-danger text-center alert-small" v-if="flash.error" role="alert">
                            {{ flash.error }}
                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </body>

</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    data() {
        return {
            form: {
                email: 'admin@admin.com',
                password: 'Admin.123',
            },
        };
    },
    props: {
        errors: Object,
        flash: Object,
    },
    methods: {
        handleLogin() {
            this.$inertia.post("handleLogin", this.form);
        },
    },
    computed: {
        emailError() {
            return !!this.errors.email;
        },
        passwordError() {
            return !!this.errors.password;
        },
        credentialError() {
            return !!this.flash.error;
        }
    },
};

</script>

<style type="text/css">
.divider {
    width: 100%;
    height: 1px;
    background: #bbb;
    margin: 1rem 0;
}

a {
    color: inherit;
    text-decoration: none;
}

.clickable-row:hover {
    cursor: pointer;
}

.alert-small {
    font-size: 16px;
    padding: 6px;
}
</style>
