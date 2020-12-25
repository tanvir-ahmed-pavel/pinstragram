<template>
	<div class="container">
		
		<div style="padding-left: 7%; padding-right: 7%;">
			
			<div class="row pt-2 pb-5">
				
				<div class="col-md-3">
					<div class="float-right mr-5 shadow overflow-hidden d-flex justify-content-center align-items-center"
					     style="height: 170px; width: 170px; border: 3px solid #ffffff; border-radius: 50%;">
						<img v-if="profile && !imgPre" :src="'/storage/'+profile.profile_img" alt="img"
						     style="height: 100%; width: auto;">
						<img v-if="imgPre" :src="imgPre" alt="img"
						     style="height: 100%; width: auto;">
						<!--						<img v-if="!!profile.profile_img" :src="'/storage/'+this.profile.profile_img" alt="img"-->
						<!--						     style="height: 100%; width: auto;">-->
					
					</div>
				</div>
				
				<!--				           Profile Info -->
				
				<div class="col-md-5 pt-0">
					<div class="ml-1">
						<div class="d-flex justify-content-between">
							
							
							<!--							            follow-->
							<div class="d-flex align-items-baseline pb-3">
								<div>
									<div class="h1" style="font-weight: 100;">{{ this.user.name }}</div>
								</div>
								
								<!--								<a class="btn btn-sm btn-outline-secondary pl-2 pr-2 ml-4 mb-1 p-0"-->
								<!--								   href="#">-->
								<!--									<small>Edit Profile</small> <i class="fas fa-cogs"></i>-->
								<!--								</a>-->
							
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
								<a href="#" type="button" class="text-decoration-none text-dark" data-toggle="modal"
								   data-target="#followerModal">
									<strong>5</strong> followers
								</a>
								<!--								                        Follower Modal-->
							
							
							</div>
							
							<!--							                       Following Count-->
							
							<div>
								<a href="#" type="button" class="text-decoration-none text-dark" data-toggle="modal"
								   data-target="#followModal">
									<strong>10</strong> following
								</a>
								
								<!--								                        Following Modal-->
							</div>
						
						</div>
						
						<!--						                    Profile info section-->
						
						<div v-if="profile" class="pt-4 font-weight-bold">{{ this.profile.title }}</div>
						<div v-if="profile">{{this.profile.description}}</div>
						<div v-if="profile"><a href="https://www.">{{this.profile.url}}</a></div>
					
					</div>
				</div>
			
			
			</div>
		
		</div>
		
		<form class="pt-4">
			
			<div class="row">
				<div class="col-8 offset-1">
					
					<div class="row">
						<h1>Edit Profile</h1>
					</div>
					<div class="row pt-2 pb-2">
						<label for="profile_image" class="col-md-4 col-form-label">Profile Image</label>
						
						<input type="file" @change="imgUpload" class="form-control-file" id="profile_image"
						       name="profile_img">
						
						<strong></strong>
					
					</div>
					<div class="form-group row">
						<label for="title" class="col-md-4 col-form-label">Title</label>
						
						<input id="title" v-model="title" type="text" class="form-control" name="title"
						       autocomplete="title" autofocus>
						
						
						<span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
					
					</div>
					
					<div class="form-group row">
						<label for="description" class="col-md-4 col-form-label">Description</label>
						
						<input id="description" v-model="description" type="text" class="form-control"
						       name="description" autocomplete="description" autofocus>
						
						
						<span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
					
					</div>
					
					<div class="form-group row">
						<label for="url" class="col-md-4 col-form-label">URL</label>
						
						<input id="url" v-model="url" type="text" class="form-control" name="url"
						       autocomplete="url" autofocus>
						
						
						<span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
					
					</div>
					
					<div class="row pt-4">
						<button class="btn btn-primary" type="submit" @click.prevent="updateProfile">
							Save Profile
						</button>
					</div>
				
				</div>
			</div>
		</form>
	</div>
</template>

<script>
    export default {
        name: "ProfileEdit",
        created() {
            this.getProfile();
        },
        data() {
            return {

                title: '',
                description: '',
                url: '',
                profile_img: '',
                imgPre: '',
            }
        },
        methods: {
            getProfile() {
                this.$store.dispatch('getProfile', this.user.id);
            },
            imgUpload(e) {
                let fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.imgPre = e.target.result;
                };
                this.profile_img = e.target.files[0];

            },
            updateProfile() {
                let formData = new FormData();
                formData.append('title', this.title);
                formData.append('profile_img', this.profile_img);
                formData.append('url', this.url);
                formData.append('description', this.description);
                formData.append('_method', 'PUT');


                //
                // console.log();

                axios.post('/api/profile/' + this.$route.params.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW',
                    }
                }).then((response) => {
                    this.$router.push({path: '/profile/' + this.$route.params.id});
                    // this.$store.dispatch('updateProfile', this.$route.params.id).then(()=>{
                    //     this.$router.push({path: '/profile/'+this.$route.params.id});
                    // })
                })

                // this.$store.dispatch('updateProfile', this.formData).then(()=>{
                //     this.$router.push({path: '/profile/'+this.$route.params.id});
                // });
            },
        },
        computed: {
            user() {
                return this.$store.getters.user;
            },
            profile() {
                return this.$store.getters.getProfile;
            }
        },
    }
</script>

<style scoped>

</style>