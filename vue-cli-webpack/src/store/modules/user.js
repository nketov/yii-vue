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
            state.user = data;
        }
    },
    actions: {
        initUser(store) {
            axios({
                method:'post',
                url: '/api/current-user-info',
                responseType: 'json'
            }).then((response) => {
                store.commit('initUser', response.data);
            }).catch(error => console.log(error));
        }
    }
};

