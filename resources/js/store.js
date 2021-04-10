import {getUser} from "./authHelper";

const authUser = getUser();
export default {
    state: {
        // Auth

        auth: !!authUser,
        authUser: authUser,
        authFollowings: [],


        // Loading

        loading: false,
        followLoading:false,
        postLoading:false,

        // Validation

        authErrors: null,
        validationErrors: null,

        // DATA

        posts: [],
        singlePost: null,
        profile: null,
        isFollowing:null,

        //Likes

        liked: null,
        likeLoad: false,



    },

    getters: {
        loading(state){
            return state.loading;
        },
        postLoading(state){
          return state.postLoading;
        },
        fLoading(state){
          return state.followLoading;
        },
        following(state){
            return state.isFollowing;
        },

        authFollowingsG(state){
            return state.authFollowings;
        },

        user(state){
            return state.authUser;
        },
        auth(state){
            return state.auth;
        },
        authErrors(state){
            return state.authErrors;
        },
        validationErrors(state){
            return state.validationErrors;
        },
        getPosts(state){
            return state.posts;
        },
        getSinglePost(state){
            return state.singlePost;
        },
        getProfile(state){
            return state.profile;
        },

        //Likes

        isLiked(state){
            return state.liked;
        }

    },

    mutations: {

        // loading mutation
        ////

        // auth loading

        loading(state) {
            state.loading=true;
        },

        // Follow component loading

        fLoading(state){
            state.followLoading = true;
        },
        postLoadingM(state){
            state.postLoading = true;
        },
        login(state){
            state.loading = true;
            state.authErrors = null;
        },
        loginSuccess(state, payload){
            state.loading = false;
            state.authErrors = null;
            state.auth = true;
            state.authUser = payload;
            localStorage.setItem('authUser', JSON.stringify(state.authUser))
        },

        loginFailed(state, payload){
            state.loading = false;
            state.authErrors = payload;
            state.auth = false;
            state.authUser = null;
            localStorage.removeItem('authUser');
        },
        registerFailed(state, payload){
            state.loading = false;
            state.validationErrors = payload;
            state.auth = false;
            state.authUser = null;
            localStorage.removeItem('authUser');
        },

        logout(state){
            state.auth = false;
            state.loading = false;
            state.authUser = null;
            localStorage.removeItem('authUser');
        },
        getPosts(state, payload){
            state.posts = payload;
            state.loading = false;
            state.postLoading = false;
        },
        getSinglePost(state, payload){
            state.singlePost = payload;
            state.loading = false;
            state.postLoading = false;
        },
        getProfile(state, payload) {
            state.profile = payload;
            state.loading = false;
        },

        // Delete Post from store

        deletePost(state, payload){
            let post= state.posts.map(post => post.id).indexOf(payload);

            state.posts.splice(post, 1);
        },

        // Follow

        follow(state, payload) {

        },

        // Likes

        likeLoad(state){
            state.likeLoad = true;
        },
        isLiked(state, payload){
            state.likeLoad = false;
            state.liked = payload;
        },
        like(state, payload){

            if(payload[1]){
                let post = state.posts.find(post => post.id == payload[0]);
                let like = post.liked_by.map(like => like.id).indexOf(state.authUser.id);
                post.liked_by.splice(like, 1);
            } else {
                let post = state.posts.find(post => post.id == payload[0]);
                post.liked_by.push(state.authUser);
            }
            state.likeLoad = false;

            // state.liked = !state.isLiked;
        },

        // Get the following list of current user

        authFollowingsM(state, payload){
            state.authFollowings = payload;
            state.followLoading = false;
        }

    },


    actions: {

        // loading Action
        ////

        // Auth loading

        loading(context){
          context.commit('loading');
        },

        //

        login(context){
            context.commit("login");
        },
        loginSuccess(context, payload) {
            context.commit("loginSuccess", payload);
        },
        loginFailed(context, payload){
            context.commit("loginFailed", payload);
        },
        registerFailed(context, payload){
            context.commit("registerFailed", payload);
        },
        logout(context){
            context.commit("logout");
        },

        // Get Dashboard Post

        getPosts(context){
            axios.get('/api/post').then((response)=>{
                context.commit("getPosts", response.data.posts)
            })
        },
        getSinglePost(context, payload){
            axios.get('/api/post/'+payload).then((response)=>{
                context.commit("getSinglePost", response.data.post)
            })
        },
        getUserPosts(context, payload){
            axios.get('/api/profile/post/' + payload).then((response)=>{
                context.commit("getPosts", response.data.posts)
            })
        },
        createPost(context, payload){
            axios.post('/api/post', payload);
        },

        // Get Profile with all info

        getProfile(context, payload) {
            axios.get('/api/profile/' + payload).then((response)=>{
                context.commit('getProfile', response.data.profile);
            })
        },

        // Delete Post

        deletePost(context, payload){
            axios.delete('/api/post/'+payload).then(()=>{
                context.commit('deletePost', payload); // can be improved by adding "add" method
            })
        },

        // Follow

        follow(context, payload){
            axios.post('/api/follow/'+payload).then(()=>{
                context.dispatch('authFollowingsA');

                // for updathing Folloers and following lis
                // context.dispatch('getProfile', rootProfileId);
            })
        },

        // Like

        likeLoad(context) {
            context.commit('likeLoad');
        },
        isLiked(context, payload){
            axios.get('/api/isLiked/'+payload).then((response)=>{
                context.commit('isLiked', response.data);
            })
        },

        like(context, payload) {
            axios.post('/api/like/'+payload[0]).then(()=>{
                context.commit('like', payload);
            })
        },

        // Get following list of auth user

        authFollowingsA(context){
          axios.get('/api/authFollowings').then((res) => {
              context.commit('authFollowingsM', res.data.followings);
          })
        },


    },



}
