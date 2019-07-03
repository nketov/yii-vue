import VueRouter from 'vue-router';


import LandingPage from './pages/LandingPage.vue';
import AboutPage from './pages/AboutPage.vue';
import LoginPage from './pages/LoginPage.vue';
import MyPage from './pages/MyPage.vue';


let routes = [
    {
        path: '/',
        component: LandingPage,
        name: 'landing'
    },
    {
        path: '/about',
        component: AboutPage,
        name: 'about'
    },
    {
        path: '/login',
        component: LoginPage,
        name: 'login'
    },
    {
        path: '/my-page',
        component: MyPage,
        name: 'MyPaGe'
    }
];

let router = new VueRouter({
    mode: 'history',
    routes
});

export default router;
