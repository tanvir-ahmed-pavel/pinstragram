import Home from './commponent/Home';
import Login from './commponent/Login';
import Dashboard from './commponent/Dashboard';
import Register from "./commponent/Register";
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
];