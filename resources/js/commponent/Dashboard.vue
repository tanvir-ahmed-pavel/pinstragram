<template>
	<div v-if="user">
<!--		<div v-if="user">-->
<!--			{{user.name}}-->
<!--			<br>-->
<!--			{{user.email}}-->
<!--		</div>-->
<!--		-->
<!--		<div v-if="error">-->
<!--			{{error.message}}-->
<!--		</div>-->
		<create-post></create-post>
		<br>
		<show-post :get-posts="getPosts"></show-post>
	</div>

</template>

<script>
    import CreatePost from "./post/CreatePost";
    import ShowPost from "./ShowPost";
    export default {
        name: "Dashboard",
        components: {ShowPost, CreatePost},
        data () {
            return {
	            error: null,
            }
	    },
        created() {
            // request for post
            this.$store.commit('loading');
            this.$store.dispatch('getPosts');
        },
        mounted () {

        },
	    methods: {

	    },
	    computed: {

            // get user from store
            user(){
	            return this.$store.getters.user;
            },

            // get post from store
            getPosts() {
                return this.$store.getters.getPosts;
            },
	    }
    }
</script>

<style scoped>

</style>
