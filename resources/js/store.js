import {getUser} from "./authHelper";

const authUser = getUser();
export default {
    state: {
        // Auth

        auth: !!authUser,
        authUser: authUser,

        // Loading

        loading: false,
        followLoading:false,

        // Validation

        authErrors: null,
        validationErrors: null,

        // DATA

        posts: [],
        singlePost: null,
        profile: null,
        isFollowing:null,
    },

    getters: {
        loading(state){
            return state.loading;
        },
        fLoading(state){
          return state.followLoading;
        },
        following(state){
            return state.isFollowing;
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
        },
        getSinglePost(state, payload){
            state.singlePost = payload;
            state.loading = false;
        },
        getProfile(state, payload) {
            state.profile = payload;
            state.loading = false;
        },
        isFollowing(state, payload){
            state.isFollowing = payload;
            state.followLoading = false;
        },
        follow(state) {
            state.isFollowing = !state.isFollowing;
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
            axios.post('/api/post', payload).then(()=>{
                context.dispatch('getPosts'); // can be improved by adding "add" method
            })
        },
        getProfile(context, payload) {
            axios.get('/api/profile/' + payload).then((response)=>{
                context.commit('getProfile', response.data.profile);
            })
        },
        deletePost(context, payload){
            axios.delete('/api/post/'+payload).then(()=>{
                context.dispatch('getPosts'); // can be improved by adding "add" method
            })
        },
        following(context, payload){
            axios.get('/api/isFollowing/'+payload).then((response)=>{
                context.commit('following', response.data);
            });
        },
        follow(context, payload){
            axios.post('/api/follow/'+payload).then(()=>{
                context.commit('follow');
            })
        },

    },



}
