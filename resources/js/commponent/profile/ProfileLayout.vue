<template>
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
