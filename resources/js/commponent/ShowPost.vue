<template>
	<div>

		<div v-for="post in this.getPosts" :key="post.id">
			<!--			{{post}}-->

			<!--				post section-->
<!--			<div class="row">-->
<!--				<div class="col-md-8">-->

<!--					<div class="card mb-4 shadow-sm">-->
<!--						<div>-->

<!--							<div class="card-body p-0 ml-3 mr-3 mt-2">-->
<!--								{{post.user.name}}-->
<!--								<div class="d-flex justify-content-between align-items-center pb-2">-->

<!--									<p class="card-text lead pb-3 pt-3"-->
<!--									   style="font-size: 22px; letter-spacing: 1px; word-spacing: 1px;">-->
<!--										{{post.content}}</p>-->
<!--								</div>-->
<!--							</div>-->
<!--							<div class="card-footer"></div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-title card-header shadow-sm justify-content-between align-items-center">
                            <div class="d-flex">
                                <img src="https://gatorprints.com/wp-content/uploads/2015/04/Sample-Logo-square.png"
                                     class="post_title_img"/>
                                <div class="name-and-time">
                                    <div>
                                        <a class="name my-0 py-0" href="#">{{post.user.name}}</a>
                                        </div>
                                    <div class="time">20 minutes ago</div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="dropbtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-three-dots card-head-icon" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                    </svg>
                                </button>
                                <div class="dropdown-content">
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                             class="bi bi-fullscreen mr-2" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4A1.5 1.5 0 0 1 1.5 0h4a.5.5 0 0 1 0 1h-4zM10 .5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 16 1.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5zM.5 10a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 0 14.5v-4a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v4a1.5 1.5 0 0 1-1.5 1.5h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                        View
                                    </a>
                                    <a href="#" class="edit-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                             class="bi bi-tools mr-2" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M0 1l1-1 3.081 2.2a1 1 0 0 1 .419.815v.07a1 1 0 0 0 .293.708L10.5 9.5l.914-.305a1 1 0 0 1 1.023.242l3.356 3.356a1 1 0 0 1 0 1.414l-1.586 1.586a1 1 0 0 1-1.414 0l-3.356-3.356a1 1 0 0 1-.242-1.023L9.5 10.5 3.793 4.793a1 1 0 0 0-.707-.293h-.071a1 1 0 0 1-.814-.419L0 1zm11.354 9.646a.5.5 0 0 0-.708.708l3 3a.5.5 0 0 0 .708-.708l-3-3z"/>
                                            <path fill-rule="evenodd" d="M15.898 2.223a3.003 3.003 0 0 1-3.679 3.674L5.878 12.15a3 3 0 1 1-2.027-2.027l6.252-6.341A3 3 0 0 1 13.778.1l-2.142 2.142L12 4l1.757.364 2.141-2.141zm-13.37 9.019L3.001 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <a href="#" class="delete-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                             class="bi bi-trash2 mr-2" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M3.18 4l1.528 9.164a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836L12.82 4H3.18zm.541 9.329A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671L14 3H2l1.721 10.329z"/>
                                            <path d="M14 3c0 1.105-2.686 2-6 2s-6-.895-6-2 2.686-2 6-2 6 .895 6 2z"/>
                                            <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                        </svg>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="post-caption text-justify">
                                {{post.content}}
                            </div>
                            <div class="post-img">
                                {{ post.img }}
                            </div>
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
@import "../../css/show_post.css";
@import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');
</style>
