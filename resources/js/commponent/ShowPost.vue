<template>
	<div>
		
		<div v-for="post in this.getPosts" :key="post.id">
			<!--			{{post}}-->
			
			<!--				post section-->
			<div class="row">
				<div class="col-md-8">
					
					<div class="card mb-4 shadow-sm">
						<div>
							
							<div class="card-body p-0 ml-3 mr-3 mt-2">
								{{post.user.name}}
<!--								<div class="d-flex justify-content-between align-items-center pb-2">-->
									
									<p class="card-text lead pb-3 pt-3"
									   style="font-size: 22px; letter-spacing: 1px; word-spacing: 1px;">
										{{post.content}}</p>
<!--								</div>-->
							</div>
							<img v-if="post.img" class="card-img-bottom" :src="'/storage/'+post.img" alt="Card image cap">
							<div class="card-footer"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	</div>

</template>

<script>
    export default {
        name: "ShowPost",
	    created() {
            if (this.$router.currentRoute.path === '/dashboard'){
                this.$store.dispatch('getPosts');
            } else {
                this.$store.dispatch('getUserPosts', this.$route.params.id);
            }
        },
        mounted() {
            // console.log(this.$store.getters.posts);
        },
        computed: {
            getPosts() {
                return this.$store.getters.getPosts;
                
            }
        }
    }
</script>

<style scoped>

</style>