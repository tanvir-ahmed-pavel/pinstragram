<template>
	<div>
<!--		<ion-icon name="heart-outline"></ion-icon>-->
		<div class="">
			
			<div v-if="this.status">
				liked
			</div>
			
			<div v-else>
				not liked
			</div>
			
		</div>
		
	
	</div>
</template>

<script>
    export default {
        name: "Like",
        props:['PostId', "status"],
	    created() {
            // this.isLiked();
        },
	    data(){
            return{
            
            }
	    },
	    methods:{
            isLiked(){
                this.$store.dispatch('isLiked', this.PostId);
            },
	    },
	    computed:{
     
	    },
    }
</script>

<style scoped>

</style>