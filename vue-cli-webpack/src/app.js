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
    propsData: {a: String},
    data: {
        drawer: null,
    },
    created() {
        store.dispatch('user/initUser');
        store.dispatch('menu/initPreferences');
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
        chooseTransitionComponentType(transition) {
            if (transition.indexOf("a-") === 0) {
                return 'transition'
            } else {
                return transition;
            }
        },
        chooseTransitionName(transition) {
            if (transition.indexOf("a-") === 0) {
                return transition
            } else {
                return '';
            }
        },
        changeDark(){
           store.dispatch('menu/changeDark')
        }
    }
});



