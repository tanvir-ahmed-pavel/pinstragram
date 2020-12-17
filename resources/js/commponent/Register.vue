<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ "Register" }}</div>
					
					<div class="card-body">
						<form @submit.prevent="registerReq">
							
							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">{{'Name'}}</label>
								
								<div class="col-md-6">
									<input id="name" type="text" v-model="form.name" class="form-control"
									       :class="errors.name ? 'is-invalid' : ''" value="" autocomplete="name"
									       autofocus>
									
									
									<strong class="invalid-feedback" role="alert" v-if="errors.name"
									        v-for="message in errors.name">
										{{message}}
									</strong>
								
								</div>
							</div>
							
							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">{{"Email"}}</label>
								
								<div class="col-md-6">
									<input id="email" type="email" v-model="form.email" class="form-control"
									       :class="errors.email ? 'is-invalid' : ''" name="email" value=""
									       autocomplete="email">
									
									
									<strong class="invalid-feedback" role="alert" v-if="errors.email"
									        v-for="message in errors.email">
										{{message}}
									</strong>
								
								</div>
							</div>
							
							<div class="form-group row">
								<label for="password"
								       class="col-md-4 col-form-label text-md-right">{{"Password"}}</label>
								
								<div class="col-md-6">
									<input id="password" v-model="form.password" type="password" class="form-control"
									       :class="errors.password ? 'is-invalid' : ''" name="password"
									       autocomplete="new-password">
									
									<strong class="invalid-feedback" role="alert" v-if="errors.password"
									        v-for="message in errors.password">
										{{message}}
									</strong>
								
								</div>
							</div>
							
							<div class="form-group row">
								<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ "Confirm Password" }}</label>
								
								<div class="col-md-6">
									<input id="password-confirm" v-model="form.password_confirmation" type="password"
									       class="form-control" name="password_confirmation"
									       autocomplete="new-password">
									<div class="mt-3">
										Already have an account??<router-link to="/login" class="text-decoration-none m-1">Login</router-link>
									</div>
								</div>
							</div>
							
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
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
                    axios.get('/user').then((response) => {
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

</style>