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
                        {{"Welcome"}}
                        <div class="crd-header-div">
                            {{"Please fill up the form to register"}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-body crd-body">
                            <form @submit.prevent="registerReq">

                                <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right text reg-log-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                        </svg>
                                    </label>

                                    <div class="col-md-9">
                                        <input id="name" type="text" v-model="form.name" class="form-control reg-log-input-field"
                                               :class="errors.name ? 'is-invalid' : ''" value="" autocomplete="name"
                                               placeholder="Name" autofocus>

                                        <strong class="invalid-feedback" role="alert" v-if="errors.name"
                                                v-for="message in errors.name">
                                            {{message}}
                                        </strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label text-md-right reg-log-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                        </svg>
                                    </label>

                                    <div class="col-md-9">
                                        <input id="email" type="email" v-model="form.email" class="form-control reg-log-input-field"
                                               :class="errors.email ? 'is-invalid' : ''" name="email" value=""
                                               placeholder="Email Address" autocomplete="email">

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
                                        <input id="password" v-model="form.password" type="password" class="form-control reg-log-input-field"
                                               :class="errors.password ? 'is-invalid' : ''" name="password"
                                               placeholder="Password" autocomplete="new-password">

                                        <strong class="invalid-feedback" role="alert" v-if="errors.password"
                                                v-for="message in errors.password">
                                            {{message}}
                                        </strong>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-2 col-form-label text-md-right reg-log-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                    </label>

                                    <div class="col-md-9">
                                        <input id="password-confirm" v-model="form.password_confirmation" type="password"
                                               class="form-control reg-log-input-field" name="password_confirmation"
                                               placeholder="Confirm Password" autocomplete="new-password">
                                        <div class="mt-3 text-muted">
                                            Already have an account??
                                            <router-link to="/login" class="text-decoration-none m-1">
                                                <strong>Login</strong>
                                            </router-link>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-2">
                                        <button type="submit" class="btn btn-reg-log">
                                            Register
                                        </button>
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
	import {register} from "../authHelper";

    export default {
        name: "Register",
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                errors: [],
            };
        },
        methods: {
            registerReq() {

                this.$store.dispatch('login');

                register(this.form).then((response) => {
                    axios.get('api/user').then((response) => {
                        this.$store.dispatch("loginSuccess", response.data);
                        this.$router.push({path: '/dashboard'});
                    });
                })
                    .catch((err)=>{
                        this.form.password = '';
                        this.form.password_confirmation = '';
                        this.$store.dispatch("registerFailed", err);
                        this.errors = this.$store.state.validationErrors;
                    });
            },

        },

    }
</script>

<style scoped>
@import "../../css/login-register.css";
</style>
