<template>
	<div class="" v-if="!this.loading">
		<button @click.prevent="follow()" class="btn-secondary btn btn-sm">
			{{!!this.status ? 'Following' : 'Follow'}}
		</button>
	</div>
</template>

<script>
    export default {
        name: "Follow",
	    props:['ProfileId',],
	    data(){
            return{
                status: '',
	            loading: false,
            }
	    },
	    mounted(){
            this.loading = true;
            this.isFollowing();
            console.log(this.status);
	    },
	    created(){
     
	    },
	    methods:{
            isFollowing(){
                axios.get('/api/isFollowing/'+this.ProfileId).then((response)=>{
                    // return this.status=response.data;
	                console.log(response.data);
	                this.status = !!response.data;
	                this.loading = false;
                 
                });
                // this.$store.dispatch('following', this.ProfileId)
            },
		    follow(){
                axios.post('/api/follow/'+this.ProfileId).then(()=>{
                    this.status = !this.status;
                })
		    }
	    },
	    computed:{
     
	    },
	    
    }
</script>

<style scoped>

</style>