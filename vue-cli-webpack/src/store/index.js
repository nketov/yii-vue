import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);


import user from './modules/user';
import menu from './modules/menu';
import products from './modules/products';
import cart from './modules/cart';
import projects from './modules/projects';


export const store = new Vuex.Store({
	modules: {
		user,
		menu,
		products,
		cart,
		projects
	},
	strict: process.env.NODE_ENV !== 'production'
});
