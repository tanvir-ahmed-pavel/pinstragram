<template>
    <div class="container" v-if="profile && !loading">

        <div class="background-container">
            <!--information section-->
            <div class="profile-info">
                <div class="cover-photo">
                    <!--cover 1280X350-->
                    <img v-if="!profile.cover_img" src="../../../assets/SampleCover.jpg" alt="Cover Photo"/>
                    <img v-else :src="'/storage/'+profile.cover_img" alt="Cover Photo"/>
                </div>

                <div class="profile-photo d-flex">
                    <profile-img :profile="profile"></profile-img>
<!--                    <img class="shadow" v-if="profile.profile_img" :src="'/storage/'+profile.profile_img" alt="img"/>-->
                    <!--				<img v-else src="../../../assets/avatar.svg" alt="img"/>-->
                    <div class="d-block profile-header">
                        <div class="profile-name d-flex">
                            <h1><strong>{{profile.user.name}}</strong></h1>
                            <div v-if="profile.id === authUser.id" class="pt-2 pl-3">
                                <router-link :to="'/profile/'+authUser.id+'/edit'"
                                             class="text-decoration-none">
                                    <div class="edit-profile d-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                             class="bi bi-sliders ml-1" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                                        </svg>
                                        <p>Edit</p>
                                    </div>
                                </router-link>
                            </div>
                            <div class="p2" v-else>

                                <!--							//Follow -->

                                <follow class="mt-2 ml-3" :isfollowing="profile.followers.some(user => user.id === this.authUser.id)" v-bind:profile-id="this.$route.params.id"></follow>

                            </div>
                        </div>

                        <!--                     count-->

                        <div class="d-flex profile-posts-followers-following">

                            <!--                        Post Count-->

                            <div class="mr-4">
                                <strong>{{getPosts.length}}</strong> {{" posts "}}
                            </div>

                            <!--                        Followers-->

                            <div class="mr-4">
                                <button type="button" class="btn btn p-0 pl-1 pr-1 btn-outline-secondary"
                                        data-toggle="modal" :disabled="!profile.followers.length" data-target="#followerModal">
                                    <strong>{{profile.followers.length}}</strong> {{" followers "}}
                                </button>
                            </div>

                            <!--                        Following-->
                            <div class="mr-4">
                                <button type="button" class="btn p-0 pl-1 pr-1 btn-outline-secondary"
                                        data-toggle="modal" :disabled="!profile.user.followings.length" data-target="#followingModal">
                                    <div>
                                        <strong>{{profile.user.followings.length}}</strong> {{" following"}}
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!--                    Profile description and title-->

                        <div class="profile-title" v-if="profile.title!== 'null'">
                            <strong>{{profile.title}}</strong>
                        </div>
                        <div class="profile-description" v-if="profile.description!== 'null'">
                            {{profile.description}}
                        </div>
                        <div class="profile-url" v-if="profile.url!== 'null'">
                            <a :href="profile.url" target="_blank">{{profile.url}}</a>
                        </div>

                    </div>
                </div>

            </div>

            <!--        Create & Show Post-->

            <create-post v-if="authUser.id==this.$route.params.id"></create-post>

            <show-post v :get-posts="getPosts"></show-post>
        </div>

        <!--                            Modal-->

        <followings-modal :followings="profile.user.followings" :auth-user="authUser" :data-target="'followingModal'"></followings-modal>
<!--        <likelist-modal :likes="PostLikes" :auth-user="authUser" :data-target="'likedByModal'"></likelist-modal>-->
        <followers-modal :followers="profile.followers" :auth-user="authUser" :data-target="'followerModal'"></followers-modal>
    </div>

</template>

<script>
    import ShowPost from "../ShowPost";
    import CreatePost from "../post/CreatePost";
    import Follow from "../Follow";
    import FollowersModal from "../modals/FollowersModal";
    import FollowingsModal from "../modals/FollowingsModal";
    import LikelistModal from "../modals/LikelistModal";
    import ProfileImg from "./ProfileImg";

    export default {
        name: "ProfileLayout",
        components: {ProfileImg, LikelistModal, FollowingsModal, FollowersModal, Follow, CreatePost, ShowPost},
        created() {

            // int Loading
            this.$store.dispatch('loading');

            // request for Profile
            this.$store.dispatch('getProfile', this.$route.params.id);

            // request for post
            this.$store.dispatch('getUserPosts', this.$route.params.id);
        },
        mounted() {

        },
        data() {
            return {}
        },

        // reactive render

        watch: {
            '$route.params.id'() {
                // int Loading
                this.$store.dispatch('loading');

                this.$store.commit('postLoadingM');

                // request for Profile
                this.$store.dispatch('getProfile', this.$route.params.id);

                // request for post
                this.$store.dispatch('getUserPosts', this.$route.params.id);
            },
        },
        methods: {},
        computed: {

            // get user from store
            authUser() {
                return this.$store.getters.user;
            },

            // get profile from store
            profile() {
                return this.$store.getters.getProfile;
            },
            loading() {
                return this.$store.getters.loading;
            },

            // get post from store
            getPosts() {
                return this.$store.getters.getPosts;
            },
            authFollowings(){
                return this.$store.getters.authFollowingsG;
            },
        }
    }
</script>

<style scoped>
    @import "../../../css/profile.css";

    body.modal-open .background-container{
        -webkit-filter: blur(4px);
        -moz-filter: blur(4px);
        -o-filter: blur(4px);
        -ms-filter: blur(4px);
        filter: blur(4px);
        /*filter:progid:DXImageTransform.Microsoft.Blur(PixelRadius='4');*/
    }
</style>
