<template>
	<div class="">
		<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
			<div class="container">

					<router-link class="navbar-brand" v-if="auth" to="/dashboard">Home</router-link>
					<router-link class="navbar-brand" v-else to="/">Home</router-link>

				<button class="navbar-toggler" type="button" data-toggle="collapse"
				        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				        aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">

					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Authentication Links -->

						<template v-if="auth">
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
								   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ user.name }} </a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<router-link class="dropdown-item" :to="'/profile/'+this.user.id">Profile</router-link>
									<a  class="dropdown-item" href="#" @click.prevent="logout">Logout</a>
								</div>
							</li>
						</template>
						<template v-else>
							<router-link v-if="!auth" to="/login" class="text-decoration-none m-1">Login</router-link>
							<router-link v-if="!auth" to="/register" class="text-decoration-none m-1">Register</router-link>
						</template>
					</ul>
				</div>
			</div>
		</nav>
	</div>

</template>

<script>
    export default {
        name: "Header",
        data() {
            return {

            }
        },
        methods: {

            logout() {
                axios.post('/logout').then(() => {
                    this.$store.dispatch("logout");
                    this.$router.push({name: 'Login'});
                })
            },

        },
        computed: {
            auth() {
                return this.$store.getters.auth;
            },
            user() {
                return this.$store.getters.user;
            }
        },
    }
</script>

<style scoped>

</style>
