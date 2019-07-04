import Vue from 'vue';

export default {
    namespaced: true,
    state: {
        items: []
    },
    getters: {
        items(state) {
            return state.items;
        },
        itemsMap(state) {
            let itemsMap = {};

            for (let i = 0; i < state.items.length; i++) {
                let product = state.items[i];
                itemsMap[product.id_product] = product;
            }

            return itemsMap;
        },
        item: (state, getters) => (id) => {
            return getters.itemsMap[id];
        }
    },
    mutations: {
        clearItems(state) {
            state.items = [];
        },
        loadItems(state, data) {
            state.items = data;
        }
    },
    actions: {
        loadItems(store) {
            store.commit('clearItems');


            axios({
                url: '/api/test'
            }).then((response) => {
                console.log(response.data);
                store.commit('loadItems', response.data);
            }).catch(error => console.log(error));
            ;

        }
    }
};

