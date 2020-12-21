<template>
	<div class="container">
		<div style="padding-left: 7%; padding-right: 7%;">
			<div class="row pt-2 pb-5">
				
				
				
				<div class="col-md-3">
					<div class="float-right mr-5 shadow overflow-hidden d-flex justify-content-center align-items-center"
					     style="height: 170px; width: 170px; border: 3px solid #ffffff; border-radius: 50%;">
						<img src="/" alt="img"
						style="height: 100%; width: auto;">
					</div>
				</div>
				
<!--				           Profile Info -->
				
				<div class="col-md-5 pt-0">
					<div class="ml-1">
						<div class="d-flex justify-content-between">
						
							
<!--							            follow-->
							<div class="d-flex align-items-baseline pb-3">
								<div>
									<div class="h1" style="font-weight: 100;">{{ 'asd' }}</div>
								</div>
								
								<a class="btn btn-sm btn-outline-secondary pl-2 pr-2 ml-4 mb-1 p-0"
								   href="#">
								<small>Edit Profile</small> <i class="fas fa-cogs"></i>
								</a>
								
							</div>
						
						
						</div>
						
<!--						               Count Section-->
						
						<div class="d-flex">
							
<!--							                      Post count-->
							
							<div class="pr-5">
								<strong>1</strong> posts
							</div>
							
<!--							                     follower-->
							
							<div class="pr-5">
								<a href="#" type="button" class="text-decoration-none text-dark" data-toggle="modal" data-target="#followerModal">
									<strong>5</strong> followers
								</a>
<!--								                        Follower Modal-->
								
							
							</div>
							
<!--							                       Following Count-->
							
							<div>
								<a href="#" type="button" class="text-decoration-none text-dark" data-toggle="modal" data-target="#followModal">
									<strong>10</strong> following
								</a>
								
<!--								                        Following Modal-->
							</div>
						
						</div>
						
<!--						                    Profile info section-->
						
						<div class="pt-4 font-weight-bold">{{ "Hi! I'm a default Title" }}</div>
						<div>{{"Hi! I'm a default Description" }}</div>
						<div><a href="https://www.">www.com</a></div>
						{{this.profile}}
					</div>
				</div>
				
				
			
			</div>
			
<!--			       Create post-->
			
			<create-post></create-post>
			
<!--			      Post Section-->
			<show-post></show-post>
			
			<div class="row">
				<div class="col-md-12"></div>
			</div>
			
			
			
		
		</div>
	</div>
</template>

<script>
    import ShowPost from "../ShowPost";
    import CreatePost from "../post/CreatePost";
    export default {
        name: "ProfileLayout",
        components: {CreatePost, ShowPost},
	    created(){
            this.getProfile();
	    },
	    mounted(){
		   
	    },
	    methods: {
          getProfile(){
              this.$store.dispatch('getProfile', this.$route.params.id);
          }
	    },
        computed: {
            user(){
                return this.$store.getters.user;
            },
	        profile(){
                return this.$store.getters.getProfile;
	        }
        }
    }
</script>

<style scoped>

</style>