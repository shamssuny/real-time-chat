import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from './components/Login';
import Chat from './components/Chat';
import Register from "./components/Register";
Vue.use(VueRouter);

const router = new VueRouter({
    routes : [
        {
            path:'/',
            component: Login
        },
        {
            path:'/chat',
            component: Chat
        },
        {
            path:'/register',
            component: Register
        },

    ]
});

export default router;