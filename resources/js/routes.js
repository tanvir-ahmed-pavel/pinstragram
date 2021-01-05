import Home from './commponent/Home';
import Login from './commponent/Login';
import Dashboard from './commponent/Dashboard';
import Register from "./commponent/Register";
import ProfileLayout from "./commponent/profile/ProfileLayout";
import ProfileEdit from "./commponent/profile/ProfileEdit";
import ShowSinglePost from "./commponent/post/ShowSinglePost";
export const routes = [
    {
        name: 'Home',
        path: '/',
        component: Home,
    },
    {
        name: 'Login',
        path: '/login',
        component: Login,
    },
    {
        name: 'Register',
        path: '/register',
        component: Register,
    },
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: Dashboard,
        meta: {
            requirsAuth: true,
        },
    },
    {
        name: 'ShowSinglePost',
        path: '/post/:id',
        component: ShowSinglePost,
        meta: {
          requirsAuth: true,
        },
    },
    {
        name: 'ProfileLayout',
        path: '/profile/:id',
        component: ProfileLayout,
        meta: {
            requirsAuth: true,
        },
    },
    {
        name: 'ProfileEdit',
        path: '/profile/:id/edit',
        component: ProfileEdit,
        meta: {
            requirsAuth: true,
            sameAsUser:true,
        },
    },
];