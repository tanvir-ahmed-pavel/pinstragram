<template>
	<div id="main">
		<Header></Header>
		<div class="container">
			<router-view></router-view>
		</div>

	</div>
</template>

<script>
    import Header from "./Header";
    export default {
        name: "App",
        components: {Header},
	    created() {
            this.$store.dispatch('authFollowingsA');
        },
	    methods:{

	    },
    }
</script>

<style scoped>

</style>
