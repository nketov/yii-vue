import Vue from 'vue';

export default {
    namespaced: true,
    state: {
        projects: []
    },
    getters: {
        projects(state) {
            return state.projects;
        },

    },
    mutations: {
        loadProjects(state, data) {
            state.projects = data;
        }
    },
    actions: {
        loadProjects(store) {
            axios({
                url: '/project'
            }).then((response) => {
                store.commit('loadProjects', response.data.items);
            }).catch(error => console.log(error));

        }
    }
};

