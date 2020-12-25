<template>
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card crd">
                    <div class="logo-div">
                        <img class="logo" src="https://i.imgur.com/DlplRg6.jpg"
                             alt="Website logo"/>
                    </div>
                    <div class="card-header crd-header">
                        {{"Lets Go"}}
                        <div class="crd-header-div">
                            {{"Enter your email and password to login"}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-body crd-body">
                            <form @submit.prevent="registerReq">

                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label text-md-right reg-log-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                        </svg>
                                    </label>

                                    <div class="col-md-9">
                                        <input id="email" type="email" v-model="form.email" class="form-control reg-log-input-field"
                                               :class="errors.email ? 'is-invalid' : ''" name="email"
                                               placeholder="Email Address" required autocomplete="current-email" autofocus>

                                        <strong class="invalid-feedback" role="alert" v-if="errors.email"
                                                v-for="message in errors.email">
                                            {{message}}
                                        </strong>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="password" class="col-md-2 col-form-label text-md-right reg-log-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                                            <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                        </svg>
                                    </label>

                                    <div class="col-md-9">
                                        <input id="password" type="password" v-model="form.password" class="form-control reg-log-input-field"
                                               :class="errors.password ? 'is-invalid' : ''" name="password"
                                               placeholder="Password" required autocomplete="current-email" autofocus>

                                        <strong class="invalid-feedback" role="alert" v-if="errors.password"
                                                v-for="message in errors.password">
                                            {{message}}
                                        </strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-9 offset-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" v-model="form.remember" name="remember" id="remember" >

                                            <label class="form-check-label text-muted" for="remember">
                                                {{"Remember me"}}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-9 offset-md-2">
                                        <div class="mt-1 text-muted">
                                            Don't have an account??
                                            <router-link to="/register" class="text-decoration-none m-1">
                                                <strong>Register</strong>
                                            </router-link>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-2">
                                        <button @click.prevent="loginReq" type="submit" class="btn btn-primary btn-reg-log">
                                            Login
                                        </button>

                                        <!--										@if (Route::has('password.request'))-->
                                        <!--										<a class="btn btn-link" href="{{ route('password.request') }}">-->
                                        <!--											{{ __('Forgot Your Password?') }}-->
                                        <!--										</a>-->
                                        <!--										@endif-->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {login} from "../authHelper";

    export default {
        name: "Login",
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                    remember: false,
                },
                errors: [],
            };
        },
        methods: {
            loginReq() {
                this.$store.dispatch('login');

                login(this.form).then((response) => {
                    axios.get('api/user').then((response) => {
                        this.$store.dispatch("loginSuccess", response.data);
                        this.$router.push({path: '/dashboard'});
                    });
                })
                    .catch((err) => {
                        this.form.password = '';
                        this.$store.dispatch("loginFailed", err);
                        this.errors = this.$store.state.authErrors;
                    });
                // axios.post('api/login', this.form).then(response => {
                //
                //
                //     this.$router.push({path: '/dashboard'});
                // })
                //     .catch(err => {
                //         this.form.password = '';
                //         this.$store.dispatch("loginFailed", err.response.data.errors);
                //         this.errors = this.$store.state.authErrors;
                //     })
            },

        },
        computed: {}
    }
</script>

<style scoped>
@import "../../css/login-register.css";
</style>
