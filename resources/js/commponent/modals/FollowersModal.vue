<template>
    <div class="modal fade shadow" :id="DataTarget" tabindex="-1" :aria-labelledby="`${DataTarget}Label`"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="pt-2  pr-3">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 30px">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0 m-0">

                    <div class="d-flex align-items-center justify-content-between" v-for="follower in followers"
                         :key="follower.id">

                        <div class="d-flex align-items-center pr-4 pl-4 pb-4">

                            <!--                                Profile Pic-->

                            <router-link class="lead text-decoration-none text-dark"
                                         :to="`/profile/${follower.id}`">
                                <button type="button" class="bg-transparent border-0" data-dismiss="modal" aria-label="Close">
                                    <div
                                        class="overflow-hidden d-flex justify-content-center align-items-center position-relative"
                                        style="height: 40px; width: 40px; border: 1.5px solid #000000; border-radius: 50%; background-color: rgba(255,255,0,0)">

                                        <img :src="`/storage/${follower.profile.profile_img}`"
                                             alt="img"
                                             style="height: 100%; width: auto;">
                                        <div class="d-flex justify-content-center align-items-center position-absolute"
                                             style="height: 38px; width: 38px; border: 2px solid #ffffff; border-radius: 50%;">
                                        </div>
                                    </div>
                                </button>
                            </router-link>

                            <!--                                Name-->

                            <div class="ml-0">
                                <div class="p-0 m-0">
                                    <router-link class="lead text-decoration-none text-dark"
                                                 :to="`/profile/${follower.id}`">
                                        <button type="button" class="bg-transparent border-0" data-dismiss="modal" aria-label="Close">
                                            {{follower.name}}
                                        </button>
                                    </router-link>

                                </div>
                            </div>

                        </div>

                        <div v-if="" class="mb-3 mr-5">
                            <follow :isfollowing="authFollowings.find(following => following.user_id === follower.id)"
                                    :profile-id="follower.id"></follow>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Follow from "../Follow";

    export default {
        name: "FollowersModal",
        components: {Follow},
        props: ['DataTarget', 'followers', 'AuthUser'],
        data() {
            return {}
        },
        watch:{
            'followers.length'(){
                if(this.followings.length == 0 ){
                    $('#followerModal').modal('hide');
                }
            }
        },
        methods: {},
        computed: {
            authFollowings() {
                return this.$store.getters.authFollowingsG;
            }
        },
    }
</script>

<style scoped>

</style>
