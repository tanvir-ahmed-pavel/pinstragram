<template>
<!--    <div class="">-->
<!--        <a class="text-decoration-none imgHover" @mouseover="chngText()" @click.prevent="">-->
            <img class="shadow" @mouseover="hover=true" @mouseout="hover=false" @click.prevent="" v-if="profile.profile_img" :src="'/storage/'+profile.profile_img" alt="img"/>
            <!--				<img v-else src="../../../assets/avatar.svg" alt="img"/>-->
<!--        </a>-->


<!--    </div>-->
</template>

<script>
    export default {
        name: "ProfileImg",
        props:['profile'],
        data(){
            return{
                hover:false,

            }
        },
        methods:{
            chngText(){
                return 'Update Profile Image'
            },
        }
    }
</script>

<style scoped>
    .imgHover:hover{

    }
</style>
