<template>
    <div>

        <div class="">

            <div class="d-flex align-items-center">

                <a @click.prevent="like()" href="#"
                   class="text-decoration-none text-dark mr-2 d-flex align-items-center">
                    <ion-icon class="clsOvereide" :class="status ? 'text-danger' : ''"
                              :name="status ? 'heart' : 'heart-outline'" style="font-size: 28px;"></ion-icon>
                </a>
                    <a @click.prevent type="button" class="text-dark text-decoration-none"
                       data-toggle="modal" :disabled="!like_count" :data-target="`#likedByModal${PostId}`">
                        {{like_count}} likes
                    </a>

            </div>

        </div>

        <likelist-modal :likes="PostLikes" :auth-user="user" :data-target="`likedByModal${PostId}`"></likelist-modal>
    </div>
</template>

<script>

    import LikelistModal from "./modals/LikelistModal";
    export default {
        name: "Like",
        components: {LikelistModal},
        props: ['PostLikes', 'AuthUser', 'PostId',],
        created() {
        },
        data() {
            return {
                status: !!this.isLiked(),
                like_count: this.likeCount(),
            }
        },
        methods: {
            isLiked() {
                return this.PostLikes.some(user => user.id === this.AuthUser);
            },
            likeCount() {
                return this.PostLikes.length;
            },
            like() {
                this.$store.dispatch('likeLoad');
                this.$store.dispatch('like', [this.PostId, this.status]);
                this.status = !this.status;
                if (this.status === false) {
                    this.like_count = this.like_count - 1;
                } else {
                    this.like_count = this.like_count + 1;
                }

            },
        },
        computed: {
            user() {
                return this.$store.getters.user;
            }
        },
    }
</script>

<style scoped>
    .clsOvereide {
        visibility: visible !important;
    }
</style>
