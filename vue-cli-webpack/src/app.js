import router from './routes.js';
import {store} from './store';

import css from './css/site.css';
import sass from './css/main.sass';


require('./bootstrap');

window.Vue = require('vue');

import {mapGetters} from 'vuex';


window.app = new Vue({
    el: '#app',
    router,
    store,
    data: {
        //
    },
    computed: {
        ...mapGetters('menu', {
            menuList: 'items'
        }),
        ...mapGetters('cart', {
            lengthInCart: 'cnt'
        })
    },
    methods: {
        isActiveMenu(path) {
            return window.location.pathname == path;
        }
    }
});



