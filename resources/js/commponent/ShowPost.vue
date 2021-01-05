<template>
	<div v-if="getPosts">
		<div v-for="post in this.getPosts" :key="post.id">
			<div class="row">
				<div class="col-md-8">
					<div class="card mb-4 shadow-sm">
						<div class="card-title card-header shadow-sm justify-content-between align-items-center">
							<!--------- HEADER PROPERTIES -------->
							<div class="d-flex">
								<router-link :to="'/profile/'+post.user.id" class="name my-0 py-0">
									<img :src="'/storage/'+post.user.profile.profile_img"
									     class="post_title_img" alt="Profile image"/>
								</router-link>
								<div class="name-and-time">
									<div class="d-block">
										<router-link :to="'/profile/'+post.user.id" class="name my-0 py-0">
											{{post.user.name}}
										</router-link>
									</div>
									<div class="time text-muted">
										{{moment(post.created_at).fromNow()}}
									</div>
								</div>
							</div>
							<!--------- DROPDOWN -------->
							<div class="dropdown mt-2 mr-3">
								<a class="text-muted text-decoration-none" href="#" role="button"
								   id="dropdownMenuLink"
								   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									     class="bi bi-three-dots card-head-icon" viewBox="0 0 16 16">
										<path fill-rule="evenodd"
										      d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
									</svg>
								</a>
								<div class="dropdown-menu dropdown-menu-right p-0 m-0">
									<router-link :to="'/post/'+post.id" class="dropdown-item view-btn">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
										     fill="currentColor"
										     class="bi bi-fullscreen mr-2" viewBox="0 0 16 16">
											<path fill-rule="evenodd"
											      d="M1.5 1a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4A1.5 1.5 0 0 1 1.5 0h4a.5.5 0 0 1 0 1h-4zM10 .5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 16 1.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5zM.5 10a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 0 14.5v-4a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v4a1.5 1.5 0 0 1-1.5 1.5h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5z"/>
										</svg>
										View
									</router-link>
									<a @click.prevent="editing=post.id" v-if="post.user.id === user.id" href="#"
									   class="dropdown-item edit-btn">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
										     fill="currentColor"
										     class="bi bi-tools mr-2" viewBox="0 0 16 16">
											<path fill-rule="evenodd"
											      d="M0 1l1-1 3.081 2.2a1 1 0 0 1 .419.815v.07a1 1 0 0 0 .293.708L10.5 9.5l.914-.305a1 1 0 0 1 1.023.242l3.356 3.356a1 1 0 0 1 0 1.414l-1.586 1.586a1 1 0 0 1-1.414 0l-3.356-3.356a1 1 0 0 1-.242-1.023L9.5 10.5 3.793 4.793a1 1 0 0 0-.707-.293h-.071a1 1 0 0 1-.814-.419L0 1zm11.354 9.646a.5.5 0 0 0-.708.708l3 3a.5.5 0 0 0 .708-.708l-3-3z"/>
											<path fill-rule="evenodd"
											      d="M15.898 2.223a3.003 3.003 0 0 1-3.679 3.674L5.878 12.15a3 3 0 1 1-2.027-2.027l6.252-6.341A3 3 0 0 1 13.778.1l-2.142 2.142L12 4l1.757.364 2.141-2.141zm-13.37 9.019L3.001 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"/>
										</svg>
										Edit
									</a>
									<a href="#" @click.prevent="deletePost(post.id)" v-if="post.user.id === user.id"
									   class="dropdown-item delete-btn">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
										     fill="currentColor"
										     class="bi bi-trash2 mr-2" viewBox="0 0 16 16">
											<path fill-rule="evenodd"
											      d="M3.18 4l1.528 9.164a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836L12.82 4H3.18zm.541 9.329A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671L14 3H2l1.721 10.329z"/>
											<path d="M14 3c0 1.105-2.686 2-6 2s-6-.895-6-2 2.686-2 6-2 6 .895 6 2z"/>
											<path fill-rule="evenodd"
											      d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
										</svg>
										Delete
									</a>
								</div>
							</div>
						</div>
						<!--------- POST CONTENT AND IMAGE -------->
						
						<div class="card-body post-body">
							<div v-if="editing === post.id">
								<form>
									
									<textarea autofocus placeholder="Update your caption" id="content" style="resize: none" class="post-caption text-justify form-control border-0" rows="2" v-model="form.content=post.content" name="content"></textarea>
									<input type="submit" class="ml-3 mt-2 mb-2 btn btn-success btn-sm" value="Save" @click.prevent="updatePost(post.id)">
									<button @click.prevent="editing=false" class="btn btn-sm btn-secondary">cancel</button>
								</form>
							</div>
							<div v-if="post.content">
								<div v-if="editing !== post.id">
									<div class="post-caption text-justify" v-if="post.content.toString().length >= 150">
										{{post.content.toString().substring(0, 149) + '... ' }}
										
										<a :href="''" class="text-decoration-none">see more</a>
									</div>
									<div class="post-caption text-justify" v-else>
										{{post.content.toString()}}
									</div>
								</div>
							</div>
							<div>
								<img class="post-img" v-if="post.img" :src="'/storage/' + post.img" width="100%"
								     alt="Post's image"/>
							</div>
						</div>
						<!--------- LIKE COMMENT SHARE -------->
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    let moment = require('moment');
    export default {
        name: "ShowPost",
        created() {
            if (this.$router.currentRoute.path === '/dashboard') {
                this.$store.dispatch('getPosts');
            } else {
                this.$store.dispatch('getUserPosts', this.$route.params.id);
            }
        },
        mounted() {
            // console.log(this.$store.getters.posts);
        },
        data() {
            return {
                moment: moment,
                form:{
                    content: '',
                    _method: 'PATCH'
                },

                editing: false,
            }
        },
        methods: {
            deletePost(payload){
                if (confirm("Are you sure you want to delete this post??")){
                    this.$store.dispatch('deletePost', payload);
                }
            },
            cancelEdit(payload){
                this.form.content=payload;
                this.editing = false;
            },
            updatePost(payload) {
                axios.post('/api/post/'+payload, this.form).then(()=>{

                });
                // this.$store.dispatch('updatePost', payload);
                // console.log(this.content);
                this.editing = false;
            },
        },
        computed: {
            getPosts() {
                return this.$store.getters.getPosts;
            },
            user() {
                return this.$store.getters.user;
            }
        }
    }
</script>

<style scoped>
	@import "../../css/show_post.css";
	@import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');
</style>
