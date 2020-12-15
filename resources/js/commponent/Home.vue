<template>
	<div class="container">
		<h1>{{welcome}}</h1>
	</div>
</template>

<script>
    export default {
        name: "Home",
	    
	    computed: {
            welcome(){
                return this.$store.getters.welcome;
            }
	    }
    }
</script>

<style scoped>

</style>