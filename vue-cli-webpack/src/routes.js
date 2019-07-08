import VueRouter from 'vue-router';

import AboutPage from './pages/AboutPage.vue';
import Preferences from './pages/Preferences.vue';
import LoginPage from './pages/LoginPage.vue';
import ProductsList from './pages/ProductsList';
import Product from './pages/Product';
import Cart from './pages/Cart';
import E404 from './pages/E404';

import {store} from './store';

let routes = [
    {
        path: '',
        redirect: {name: 'about'}
    },
    {
        path: '/about',
        component: AboutPage,
        name: 'about'
    },
    {
        path: '/login',
        component: LoginPage,
        name: 'login',
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
