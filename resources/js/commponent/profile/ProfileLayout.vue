<template>
<!--	<div class="container">-->
<!--		<div style="padding-left: 7%; padding-right: 7%;">-->
<!--			<div class="row pt-2 pb-5">-->
<!--				-->
<!--				<div class="col-md-3">-->
<!--					<div class="float-right mr-5 shadow overflow-hidden d-flex justify-content-center align-items-center"-->
<!--					     style="height: 170px; width: 170px; border: 3px solid #ffffff; border-radius: 50%;">-->
<!--						<img v-if="profile" :src="'/storage/'+profile.profile_img" alt="img"-->
<!--						style="height: 100%; width: auto;">-->
<!--					</div>-->
<!--				</div>-->

<!--&lt;!&ndash;				           Profile Info &ndash;&gt;-->

<!--				<div class="col-md-5 pt-0">-->
<!--					<div class="ml-1">-->
<!--						<div class="d-flex justify-content-between">-->


<!--&lt;!&ndash;							            follow&ndash;&gt;-->
<!--							<div class="d-flex align-items-baseline pb-3">-->
<!--								<div>-->
<!--									<div class="h1" style="font-weight: 100;">{{ 'asd' }}</div>-->
<!--								</div>-->
<!--								-->
<!--									<router-link class="btn btn-sm btn-outline-secondary pl-2 pr-2 ml-4 mb-1 p-0" :to="'/profile/'+user.id+'/edit'">-->
<!--										<small>Edit Profile</small> <i class="fas fa-cogs"></i>-->
<!--									</router-link>-->
<!--								-->

<!--							</div>-->


<!--						</div>-->

<!--&lt;!&ndash;						               Count Section&ndash;&gt;-->

<!--						<div class="d-flex">-->

<!--&lt;!&ndash;							                      Post count&ndash;&gt;-->

<!--							<div class="pr-5">-->
<!--								<strong>1</strong> posts-->
<!--							</div>-->

<!--&lt;!&ndash;							                     follower&ndash;&gt;-->

<!--							<div class="pr-5">-->
<!--								<a href="#" type="button" class="text-decoration-none text-dark" data-toggle="modal" data-target="#followerModal">-->
<!--									<strong>5</strong> followers-->
<!--								</a>-->
<!--&lt;!&ndash;								                        Follower Modal&ndash;&gt;-->


<!--							</div>-->

<!--&lt;!&ndash;							                       Following Count&ndash;&gt;-->

<!--							<div>-->
<!--								<a href="#" type="button" class="text-decoration-none text-dark" data-toggle="modal" data-target="#followModal">-->
<!--									<strong>10</strong> following-->
<!--								</a>-->

<!--&lt;!&ndash;								                        Following Modal&ndash;&gt;-->
<!--							</div>-->

<!--						</div>-->

<!--&lt;!&ndash;						                    Profile info section&ndash;&gt;-->

<!--						<div v-if="profile" class="pt-4 font-weight-bold">{{ profile.title }}</div>-->
<!--						<div v-if="profile">{{profile.description}}</div>-->
<!--						<div v-if="profile"><a href="https://www.">{{profile.url}}</a></div>-->
<!--&lt;!&ndash;						{{this.profile}}&ndash;&gt;-->
<!--					</div>-->
<!--				</div>-->



<!--			</div>-->

<!--&lt;!&ndash;			       Create post&ndash;&gt;-->

<!--			<create-post></create-post>-->

<!--&lt;!&ndash;			      Post Section&ndash;&gt;-->
<!--			<show-post></show-post>-->

<!--			<div class="row">-->
<!--				<div class="col-md-12"></div>-->
<!--			</div>-->
<!--			-->

<!--		</div>-->
<!--	</div>-->

    <div class="container">
        <!--information section-->
        <div class="profile-info">
            <div class="cover-photo">
                <!--cover 1280X350-->
                <img src="../../../assets/SampleCover.jpg" alt="Cover Photo"/>
            </div>
            <div class="profile-photo d-flex">
                <img v-if="profile.profile_img" :src="'/storage/'+profile.profile_img" alt="img"/>
                <img v-else src="../../../assets/avatar.svg" alt="img"/>
                <div class="d-block profile-header">
                    <div class="profile-name d-flex">
                        <h1><strong>{{user.name}}</strong></h1>
                        <div>
                            <router-link v-if="profile.id === user.id" :to="'/profile/'+user.id+'/edit'" class="text-decoration-none">
                                <div class="edit-profile d-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sliders ml-1" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                                    </svg>
                                    <p>Edit</p>
                                </div>
                            </router-link>
                        </div>
                    </div>
                    <div class="d-flex profile-posts-followers-following">
                        <div class="mr-4">
                            <strong>{{"12"}}</strong> {{" posts "}}
                        </div>
                        <div class="mr-4">
                            <strong>{{"43223"}}</strong> {{" followers "}}
                        </div>
                        <div>
                            <strong>{{"1313"}}</strong>  {{" following"}}
                        </div>
                    </div>
                    <div class="profile-title" v-if="profile.title">
                        <div>{{profile.title}}</div>
                    </div>
                    <div class="profile-url" v-if="profile.url">
                        <a :href="profile.url" target="_blank">{{profile.url}}</a>
                    </div>
                    <div class="profile-description" v-if="profile.description">
                        {{profile.description}}
                    </div>
                </div>
            </div>
        </div>
        <create-post></create-post>
        <show-post></show-post>
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
            },
            getUser(){
                this.$store.dispatch('user', this.$route.params.id)
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
@import "../../../css/profile.css";
</style>
