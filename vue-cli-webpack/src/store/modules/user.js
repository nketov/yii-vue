import Vue from 'vue';

export default {
    namespaced: true,
    state: {
        user: window._user
    },
    getters: {
        user(state) {
            return state.user;
        },

    },
    mutations: {
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

