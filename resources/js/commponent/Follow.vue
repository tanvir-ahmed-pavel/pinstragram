<template>
	<div class="" v-if="!loading">
		<button @click.prevent="follow" class="btn btn-sm mt-2 ml-3" :class="!!following ? 'btn-danger' : 'btn-primary'">
			{{!!following ? 'Unfollow' : 'Follow'}}
		</button>
	</div>
</template>

<script>
    export default {
        name: "Follow",
	    props:['ProfileId',],
	    data(){
            return{
            
            }
	    },
	    mounted(){
            this.isFollowing();
	    },
	    created(){
            this.$store.commit('fLoading');
	    },
	    methods:{
            isFollowing(){
                
                axios.get('/api/isFollowing/'+this.ProfileId).then((response)=>{
                    this.$store.commit('isFollowing', !!response.data);
                    
                    // return this.status=response.data;
	                // console.log(response.data);
	                // this.status = !!response.data;
	                // this.loading = false;
                 
                });
                // this.$store.dispatch('following', this.ProfileId)
            },
            follow(){
                this.$store.commit('fLoading');
                this.$store.dispatch('follow', this.ProfileId)
            },
		    // follow(){
            //     axios.post('/api/follow/'+this.ProfileId).then(()=>{
            //         this.status = !this.status;
            //     })
		    // }
	    },
	    computed:{
      
		    following(){
                return this.$store.getters.following;
		    },
            loading(){
                return this.$store.getters.fLoading;
            },
	    },
	    
    }
</script>

<style scoped>

</style>