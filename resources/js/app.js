require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex';

import VueRouter from 'vue-router';
import {routes} from './routes.js';
import StoreData from './store';
import App from './commponent/App';
// import CreatePost from "./commponent/post/CreatePost";

Vue.use(Vuex);

Vue.use(VueRouter);

const store = new Vuex.Store(StoreData);

const router = new VueRouter({
    routes,
    mode: 'history',
});

router.beforeEach((to, from, next) => {
    const requirsAuth = to.matched.some(record => record.meta.requirsAuth);
    const auth = store.state.auth;
    if (requirsAuth && !auth){
        next('/login');
    } else if (to.path === '/login' && auth){
        next('/dashboard');
    } else if (to.path === '/register' && auth){
        next('/dashboard');
    }
    else {
        next();
    }
});


const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        App,
        // CreatePost,
    }
});