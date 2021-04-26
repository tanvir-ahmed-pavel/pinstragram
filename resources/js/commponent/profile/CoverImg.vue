<template>
    <div class="">
        <!--        <a class="text-decoration-none imgHover" @mouseover="chngText()" @click.prevent="">-->
        <div class=" bg position-relative" @mouseout="hover=false">


            <div v-if="AuthId == this.$route.params.id"
                 class="position-absolute text-light align-content-center"
                 style="text-align: center">
                <label for="cover_img" class="font-weight-bold m-0 label">
                    <div class="p-0 d-flex align-items-baseline justify-content-center" style="font-size: 20px; margin-bottom: -10px;">

                        <ion-icon name="camera"></ion-icon>

                        <p class="p-0 ml-2">
                            Update Cover
                            Image
                        </p>
                    </div>

                </label>
            </div>

<!--            Cancel and Save Button -->

            <div v-if="imgPre" class="button position-absolute p-2">
                <button @click="cancel()" class="btn btn-sm btn-outline-dark p-0 pl-1 pr-1 text-light">Cancel</button>
                <button @click="updateImg()" class="btn btn-sm btn-dark p-0 pl-1 pr-1 ml-2">Save
                </button>
            </div>
            <input type="file" hidden @change="imgUpload" class="form-control-file" id="cover_img"
                   name="cover_img">

<!--            Image show and Preview-->

            <img v-if="!profile.cover_img && !imgPre" src="../../../assets/SampleCover.jpg" alt="Cover Photo"/>
            <img v-else-if="profile.cover_img && !imgPre" :src="'/storage/'+profile.cover_img" alt="Cover Photo"/>
            <img v-else :src="imgPre" alt="Cover Photo"/>

        </div>


    </div>
</template>

<script>
    export default {
        name: "CoverImg",
        props: ['profile', 'AuthId'],
        created() {

        },
        data() {
            return {
                hover: false,
                cover_img: '',
                imgPre: '',

            }
        },
        methods: {
            chngText() {
                return 'Update Profile Image'
            },
            imgUpload(e) {
                let fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.imgPre = e.target.result;
                };
                this.cover_img = e.target.files[0];

            },

            updateImg() {
                let formData = new FormData();
                formData.append('cover_img', this.cover_img);
                formData.append('_method', 'PUT');

                axios.post('/api/profile/u_c_img/' + this.$route.params.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW',
                    }
                }).then((response) => {
                    this.imgPre = null;
                    this.cover_img = null;
                    this.$router.push({path: '/dashboard'});
                    // this.$store.dispatch('updateProfile', this.$route.params.id).then(()=>{
                    //     this.$router.push({path: '/profile/'+this.$route.params.id});
                    // })
                })
            },
            cancel() {
                this.imgPre = null;
                this.profile_img = null;
            }
        },
    }
</script>

<style scoped>
    .label {
        padding: 4px 8px;
        border-radius: 5px;
        opacity: 0%;
        transition: 0.5s ease-in-out;
    }
    .bg:hover .label {
        backdrop-filter: blur(5px);
        background-color: rgba(9, 9, 9, 0.28);
        opacity: 100%
    }
    .button{
        backdrop-filter: blur(10px);
        background-color: rgba(32, 32, 33, 0.28);
        top: 0;
        left: 966px;
        border-radius: 5px;
    }
</style>
