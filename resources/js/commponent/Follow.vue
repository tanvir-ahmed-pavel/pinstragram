<template>
	<div class="" v-if="!loading">
		<button @click.prevent="follow" class="btn btn-sm" :class="!!isfollowing ? 'btn-danger' : 'btn-primary'">
			{{!!isfollowing ? 'Unfollow' : 'Follow'}}
		</button>
	</div>
</template>

<script>
    export default {
        name: "Follow",
	    props:['ProfileId', 'isfollowing'],
	    data(){
            return{

            }
	    },
	    mounted(){

	    },
	    created(){
            // this.$store.commit('fLoading');
	    },
	    methods:{

            follow(){
                this.$store.commit('fLoading');
                this.$store.dispatch('follow', this.ProfileId).then(() => {
                    this.$store.dispatch('getProfile', this.$route.params.id);
                })
            },
		    // follow(){
            //     axios.post('/api/follow/'+this.ProfileId).then(()=>{
            //         this.status = !this.status;
            //     })
		    // }
	    },
	    computed:{
            // isFollowing(){
            //     return this.chkFollowing = this.followers.some(user => user.id === this.authUser.id);
            // },

            loading(){
                return this.$store.getters.fLoading;
            },
            authUser() {
                return this.$store.getters.user;
            },
	    },

    }
</script>

<style scoped>

</style>
