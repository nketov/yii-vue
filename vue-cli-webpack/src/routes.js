import VueRouter from 'vue-router';

import MainPage from './pages/MainPage.vue';
import AboutPage from './pages/AboutPage.vue';
import Preferences from './pages/Preferences.vue';
import LoginPage from './pages/user/LoginPage.vue';
import RegistrationPage from './pages/user/RegistrationPage.vue';
import PasswordRequestPage from './pages/user/PasswordRequestPage.vue';
import PasswordResetPage from './pages/user/PasswordResetPage.vue';
import ProductsList from './pages/ProductsList';
import Product from './pages/Product';
import Cart from './pages/Cart';
import E404 from './pages/E404';

import {store} from './store';

let routes = [
    {
        path: '',
        redirect: {name: 'main'}
    },
    {
        path: '/',
        component: MainPage,
        name: 'main'
    },
    {
        path: '/about',
        component: AboutPage,
        name: 'about',
        beforeEnter(from, to, next) {
            store.dispatch('projects/loadProjects');
            next();
        }

    },
    {
        path: '/login',
        component: LoginPage,
        name: 'login',
    },
    {
        path: '/registration',
        component: RegistrationPage,
        name: 'registration',
    },
    {
        path: '/password-request',
        component: PasswordRequestPage,
        name: 'password-request',
    },
    {
        path: '/password-reset/:token',
        component: PasswordResetPage,
        name: 'password-reset',
    },
    {
        path: '/preferences',
        component: Preferences,
        name: 'preferences',
    },
    {
        path: '/logout',
        beforeEnter(from, to, next) {
            axios({
                method: 'post',
                url: '/api/logout'
            }).then(() => {
                store.dispatch('user/initUser');
                router.push('/about');
                next(false);
            }).catch(error => console.log(error));
        }
    },
    {
        name: 'products',
        path: '/products',
        component: ProductsList,
        beforeEnter(from, to, next) {
            store.dispatch('products/loadItems');
            next();
        }
    },
    {
        path: '/products/:id',
        component: Product
    },
    {
        path: '/cart',
        component: Cart
    },
    {
        path: '*',
        component: E404
    }


];

let router = new VueRouter({
    mode: 'history',
    routes
});

export default router;
