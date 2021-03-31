import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import store from './store'

import information from './components/pages/information'
import login from './components/pages/login'
import mypage from './components/pages/mypage'
import register from './components/pages/register'
import service from './components/pages/service/index'
import serviceAdd from './components/pages/service/add'

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/information",
            name: "information",
            component: information,
        },
        {
            path: "/login",
            name: "login",
            component: login,
        },
        {
            path: "/mypage",
            name: "mypage",
            component: mypage,
        },
        {
            path: "/register",
            name: "register",
            component: register,
        },
        {
            path: "/service",
            name: "service",
            component: service,
        },
        {
            path: "/service/add",
            name: "service/add",
            component: serviceAdd,
        },
    ]
});
 
router.beforeEach((to, from, next) => {
    if (to.name !== 'login' && ! store.state.isLoggedIn)
        next({name: 'login'});
    else
        next();
});

export default router;