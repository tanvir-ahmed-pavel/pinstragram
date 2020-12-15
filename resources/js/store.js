import {getUser} from "./authHelper";

const user = getUser();
export default {
    state: {
        auth: !!user,
        loading: null,
        authErrors: null,
        validationErrors: null,
        user: user,
    },

    getters: {
        welcome(state){
            return state.welcome;
        },
        user(state){
            return state.user;
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
    },

    mutations: {
        login(state){
            state.loading = true;
            state.authErrors = null;
        },
        loginSuccess(state, payload){
            state.loading = false;
            state.authErrors = null;
            state.auth = true;
            state.user = payload;
            localStorage.setItem('user', JSON.stringify(state.user))
        },

        loginFailed(state, payload){
            state.loading = false;
            state.authErrors = payload;
            state.auth = false;
            state.user = null;
            localStorage.removeItem('user');
        },
        registerFailed(state, payload){
            state.loading = false;
            state.validationErrors = payload;
            state.auth = false;
            state.user = null;
            localStorage.removeItem('user');
        },

        logout(state){
            state.auth = false;
            state.loading = false;
            state.user = null;
            localStorage.removeItem('user');
        },
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
        }

    },



}