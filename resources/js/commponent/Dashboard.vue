<template>
	<div>
		<div v-if="user">
			{{user.name}}
			<br>
			{{user.email}}
		</div>
		
		<div v-if="error">
			{{error.message}}
		</div>
		
	</div>
</template>

<script>
    export default {
        name: "Dashboard",
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