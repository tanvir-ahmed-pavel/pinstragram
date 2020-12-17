<template>
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Login</div>
					
					<div class="card-body">
						<form>
							
							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
								
								<div class="col-md-6">
									<input id="email" type="email" class="form-control "
									       :class="errors.email ? 'is-invalid' : ''" v-model="form.email" name="email"
									       required autocomplete="current-email" autofocus>
									<strong class="invalid-feedback" role="alert" v-if="errors.email"
									        v-for="message in errors.email">
										{{message}}
									</strong>
									<span class="invalid-feedback">
<!--                                        <strong>{{ $message }}</strong>-->
                                    </span>
								
								</div>
							</div>
							
							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
								
								<div class="col-md-6">
									<input id="password" type="password" :class="errors.password ? 'is-invalid' : ''"
									       v-model="form.password" class="form-control" name="password"
									       autocomplete="current-password">
									
									<strong class="invalid-feedback" role="alert" v-if="errors.password"
									        v-for="message in errors.password">
										{{message}}
									</strong>
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-6 offset-md-4">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" v-model="form.remember" name="remember" id="remember" >
										
										<label class="form-check-label" for="remember">
											{{"Remember me"}}
										</label>
									</div>
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-6 offset-md-4">
									<div class="mt-1">
										Don't have an account??
										<router-link to="/register" class="text-decoration-none m-1">Register
										</router-link>
									</div>
								</div>
							</div>
							
							<div class="form-group row mb-0">
								<div class="col-md-8 offset-md-4">
									<button @click.prevent="loginReq" type="submit" class="btn btn-primary">
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

</style>