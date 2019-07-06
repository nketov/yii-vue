import Vue from 'vue';

export default {
    namespaced: true,
    state: {
        user: []
    },
    getters: {
        user(state) {
            return state.user;
        },

    },
    mutations: {
        clearUser(state) {
            state.user = [];
        },
        initUser(state, data) {
            state.user = window._PHP_user;
        }
    },
    actions: {
        initUser(store) {
            store.commit('initUser');
        }
    }
};

