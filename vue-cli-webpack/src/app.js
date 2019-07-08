import router from './routes.js';
import {store} from './store';


require('./bootstrap');

import css from './css/site.css';
import sass from './css/main.sass';

window.Vue = require('vue');

import {mapGetters} from 'vuex';


window.app = new Vue({
    el: '#app',
    router,
    store,
    propsData: { a: String },
    data: {
        drawer:null
    },
    mounted(){
        store.dispatch('user/initUser');
    },
    computed: {
        ...mapGetters('user', {
            user: 'user'
        }),
        ...mapGetters('menu', {
            preferences: 'preferences',
            menuList: 'items',
            footerMenu: 'footer'
        }),

        ...mapGetters('cart', {
            lengthInCart: 'cnt'
        }),
    },
    methods: {
        isActiveMenu(path) {
            return window.location.pathname == path;
        }
    }
});



