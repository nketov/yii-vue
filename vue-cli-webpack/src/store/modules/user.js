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
        },
        newAvatar(state, data) {
            state.user.avatar = data;
        }
    },
    actions: {
        initUser(store) {
            axios({
                method: 'post',
                url: '/api/current-user-info',
                responseType: 'json'
            }).then((response) => {
                store.commit('initUser', response.data);
            }).catch(error => console.log(error));
        },
        saveAvatar(store, file) {

            let formData = new FormData();
            formData.append('image', file);

            axios.post('/api/save-avatar',
                formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then((response) => {
                store.commit('newAvatar', response.data.avatar);
            }).catch(error => console.log(error));


        }
    }
};

