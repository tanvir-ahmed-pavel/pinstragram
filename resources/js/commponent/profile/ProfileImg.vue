<template>
    <div class="">
        <!--        <a class="text-decoration-none imgHover" @mouseover="chngText()" @click.prevent="">-->
        <div class=" bg position-relative" @mouseout="hover=false">


            <div v-if="AuthId == this.$route.params.id"
                 class="position-absolute bg-dark text-light bg-text align-content-center "
                 style="text-align: center">
                <label for="profile_image" class="font-weight-bold label">
                    <p class="p-0" style="font-size: 20px; margin-bottom: -10px;">
                        <ion-icon name="camera"></ion-icon>
                        <br>
                        Update Profile
                        <br>
                        Image
                    </p>

                </label>
            </div>

            <input type="file" hidden @change="imgUpload" class="form-control-file" id="profile_image"
                   name="profile_img">

            <img class="shadow profile-photo-img " style="left: 0%; top: 0%; font-size: 20px;"
                 v-if="profile.profile_img && !imgPre" @mouseover="hover=true" @click.prevent=""
                 :src="'/storage/'+profile.profile_img" alt="img"/>

            <img v-else class="shadow profile-photo-img " style="left: 0%; top: 0%; font-size: 20px;"
                 @mouseover="hover=true" @click.prevent=""
                 :src="imgPre" alt="img"/>


            <button v-if="imgPre" @click="cancel()" class="btn btn-sm btn-outline-dark p-0 pl-1 pr-1 ml-5 mt-3">Cancel</button>
            <button v-if="imgPre" @click="updateImg()" class="btn btn-sm btn-primary p-0 pl-1 pr-1 mt-3 ml-2">Save
            </button>
            <!--            Update Text-->


        </div>


        <!--				<img v-else src="../../../assets/avatar.svg" alt="img"/>-->
        <!--        </a>-->


    </div>
</template>

<script>
    export default {
        name: "ProfileImg",
        props: ['profile', 'AuthId'],
        created() {
            console.log(this.$route.params.id);
        },
        data() {
            return {
                hover: false,
                profile_img: '',
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
                this.profile_img = e.target.files[0];

            },

            updateImg() {
                let formData = new FormData();
                formData.append('profile_img', this.profile_img);
                formData.append('_method', 'PUT');

                axios.post('/api/profile/u_p_img/' + this.$route.params.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW',
                    }
                }).then((response) => {
                    this.imgPre=null;
                    this.profile_img=null;
                    this.$router.push({path: '/dashboard' });
                    // this.$store.dispatch('updateProfile', this.$route.params.id).then(()=>{
                    //     this.$router.push({path: '/profile/'+this.$route.params.id});
                    // })
                })
            },
            cancel(){
                this.imgPre=null;
                this.profile_img=null;
            }
        },
    }
</script>

<style scoped>

    .profile-photo-img {
        height: 200px;
        width: 200px;
        /*margin: -75px 0 0 0;*/
        border-radius: 200px;
        transition: 0.5s ease-in-out;
    }


    .bg-text {
        height: 200px;
        width: 200px;
        border-radius: 200px;
        opacity: 0%;
        transition: 0.5s ease-in-out;

    }

    .bg-text:hover {
        opacity: 100%;
    }

    .label {
        margin: 60px 0;
    }

    .bg {
        height: 200px;
        width: 200px;
        margin: -75px 0 0 0;
        border-radius: 200px;
    }

    .imgHover:hover {

    }
</style>
