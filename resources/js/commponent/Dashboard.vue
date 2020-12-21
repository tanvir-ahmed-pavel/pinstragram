<template>
	<div>
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
		<show-post></show-post>
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
        mounted () {
            // this.user();
        },
	    methods: {
     
	    },
	    computed: {
            user(){
	            return this.$store.getters.user;
            }
	    }
    }
</script>

<style scoped>

</style>