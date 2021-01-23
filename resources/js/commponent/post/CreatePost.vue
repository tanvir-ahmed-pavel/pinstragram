<template>
	<div class="row">
		<div class="col-md-8 mb-4">
			<form>
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
									<router-link class="lead text-decoration-none text-dark"
									             :to="'/profile/'+this.authUser.id">
										{{authUser.name}}
									</router-link>
									<div>
										<div class="dropdown">
											<button class="p-0 btn btn-sm btn-outline-secondary dropdown-toggle"
											        type="button" id="dropdownMenuButton" data-toggle="dropdown"
											        aria-haspopup="true" aria-expanded="false">
												<small class="pl-1 pr-1">{{privacyLabel(this.privacy)}}</small>
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a class="dropdown-item" href="#">
													<div class="form-check">
														<label class="form-check-label stretched-link" for="privacy1">
															<input v-model="privacy" class="form-check-input" type="radio"
															       name="privacy" id="privacy1"
															       :value="1" @change="privacyLabel(1)">
															Public
														</label>
													</div>
												</a>
												<a class="dropdown-item" href="#">
													<div class="form-check">
														<label class="form-check-label stretched-link" for="privacy2">
															<input v-model="privacy" class="form-check-input" type="radio"
															       name="privacy" id="privacy2"
															       :value="2" @change="privacyLabel(2)">
															Friends
														</label>
													</div>
												</a>
												<a class="dropdown-item" href="#">
													<div class="form-check">
														
														<label class="form-check-label stretched-link" for="privacy3">
															<input v-model="privacy" class="form-check-input" type="radio"
															       name="privacy" id="privacy3"
															       :value="3" @change="privacyLabel(3)">
															Privet
														</label>
													</div>
												</a>
											
											</div>
										</div>
									
									</div>
								</div>
							
							</div>
						</div>
						<div>
							<div class="form-group border-0">
                                <textarea style="font-size: 25px;" rows="2" v-model="content"
                                          class="form-control border-0" name="content"
                                          placeholder="Whats on your mind..."></textarea>
							</div>
							
							<div class="d-flex justify-content-between">
								<div class="mb-3">
									<input type="file" @change="imgUpload" name="img" id="img"
									       class="form-control-file ">
									
									<img v-if="this.imgPre" :src="this.imgPre" style="max-height: 50px;" alt="">
								</div>
								<div class="form-group">
									<button :disabled="!content && !img" class="btn"
									        :class="content || img ? 'btn-primary' : 'btn-secondary'" type="submit"
									        @click.prevent="createPost()">
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
        data() {
            return {
                content: '',
                img: '',
                imgPre: '',
	            privacy: 1,
                formData: new FormData,
            }
        },
        methods: {
            imgUpload(e) {
                let fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.imgPre = e.target.result;
                };
                this.img = e.target.files[0];

            },
            createPost() {
                this.formData.append('content', this.content);
                this.formData.append('img', this.img);
                this.formData.append('privacy_id', this.privacy);
                this.$store.dispatch('createPost', this.formData).then(() => {
                    this.content = '';
                    this.img = '';
                    this.imgPre = '';
                });
            },
	        privacyLabel(privacyId){
                if (privacyId ===1){
                    return "Public";
                } else if (privacyId ===2){
                    return "Friends";
                } else {
                    return "Privet";
                }
	        }
        },
        computed: {
            authUser() {
                return this.$store.getters.user;
            }
        },
    }
</script>

<style scoped>
	@import "../../../css/create-post.css";
</style>
