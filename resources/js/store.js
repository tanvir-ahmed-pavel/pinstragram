import {getUser} from "./authHelper";

const authUser = getUser();
export default {
    state: {
        auth: !!authUser,
        loading: null,
        authErrors: null,
        validationErrors: null,
        authUser: authUser,
        posts: [],
        profile: null,
    },

    getters: {
        welcome(state){
            return state.welcome;
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
        getProfile(state){
            return state.profile;
        }
    },

    mutations: {
        login(state){
            state.loading = true;
            state.authErrors = null;
        },
        loginSuccess(state, payload){
            state.loading = false;
            state.authErrors = null;
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
        },
        getProfile(state, payload) {
            state.profile = payload;
        }
    },

    actions: {
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
        getUserPosts(context, payload){
            axios.get('/api/post/' + payload).then((response)=>{
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
        }

    },



}