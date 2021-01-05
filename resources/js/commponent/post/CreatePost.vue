<template>
	<div class="row">
		<div class="col-md-8 mb-4">
			<form  >
				<div class="card">
					<div class="card-body pb-0">
						<div class="d-flex align-items-center mt-3 pb-2">
							<div class="overflow-hidden d-flex justify-content-center align-items-center position-relative"
							     style="height: 40px; width: 40px; border: 1.5px solid #000000; border-radius: 50%; background-color: rgba(255,255,0,0)">

													<img :src="'/storage/'+authUser.profile.profile_img"
													alt="img"
													style="height: 100%; width: auto;">
								<div class="d-flex justify-content-center align-items-center position-absolute"
								     style="height: 38px; width: 38px; border: 2px solid #ffffff; border-radius: 50%;">
								</div>
							</div>
							<div class="ml-2">
								<div class="p-0 m-0">
									<!--						<a class="text-decoration-none lead text-dark" style="font-size: 20px;"-->
									<!--						   href="{{ url('/profile/'.Auth::user()->profile->user_id)}}">{{ Auth::user()->user_name }}</a>-->
								</div>

							</div>
						</div>
						<div>
							<div class="form-group border-0">
                                <textarea style="font-size: 25px;" rows="2" v-model="content" class="form-control border-0" name="content"
                                          placeholder="Whats on your mind..."></textarea>
							</div>

							<div class="d-flex justify-content-between">
								<div class="mb-3">
									<input type="file" @change="imgUpload" name="img" id="img"  class="form-control-file ">

									<img v-if="this.imgPre" :src="this.imgPre" style="max-height: 50px;" alt="">
								</div>
								<div class="form-group">
									<button :disabled="!content && !img" class="btn" :class="content || img ? 'btn-primary' : 'btn-secondary'" type="submit" @click.prevent="createPost()" >
										Post
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
    export default {
        name: "CreatePost",
	    data(){
            return{
                content: '',
	            img: '',
                imgPre: '',
	            formData: new FormData,
            }
	    },
	    methods:{
            imgUpload(e){
                let fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.imgPre = e.target.result;
                };
                this.img = e.target.files[0];

            },
            createPost(){
                this.formData.append('content', this.content);
                this.formData.append('img', this.img);
                this.$store.dispatch('createPost', this.formData).then(()=>{
                    this.content='';
                    this.img='';
                    this.imgPre='';
                });
            }
	    },
	    computed:{
          authUser(){
              return this.$store.getters.user;
          }
	    },
    }
</script>

<style scoped>
@import "../../../css/create-post.css";
</style>
