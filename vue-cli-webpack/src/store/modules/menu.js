function savePreferences(preferences) {
    axios({
        method: 'post',
        url: '/api/save-preferences',
        responseType: 'json',
        data: {
            preferences: preferences,
        }
    }).then((response) => {
        //**//
    }).catch(error => console.log(error));
}

export default {
    namespaced: true,
    state: {
        preferences: {
            pageTransition: 'v-fade-transition',
            dark: true,
            cardHeaderColor: '#333',
            cardHeaderTextColor: '#FFC',
        },
        items: [
            {
                url: '/',
                text: 'Главная',
                icon: 'desktop_windows'
            },
            {
                url: '/about',
                text: 'О нас',
                icon: 'info'
            },
            // {
            //     url: '/products',
            //     text: 'Магазин',
            //     icon: 'view_list'
            // },
            // {
            //     url: '/cart',
            //     text: 'Корзина',
            //     icon: 'shopping_cart'
            // },
            {
                url: '/preferences',
                text: 'Настройки',
                icon: 'settings'
            },
            // {
            //     url: '/checkout',
            //     text: 'Заказать',
            //     icon: 'done_outline'
            // },
            {
                url: '/checkout1',
                text: '404',
                icon: 'bug_report'
            }
        ],
        footer: {
            items:
                [
                    'Home',
                    'About',
                    'Team',
                    'Services',
                    'Blog',
                    'Contact Us'
                ],
            icons: [
                'fa fa-facebook',
                'fa fa-twitter',
                'fa fa-google-plus',
                'fa fa-linkedin',
                'fa fa-instagram'
            ]

        }
    },
    getters: {
        preferences(state) {
            return state.preferences;
        },
        items(state) {
            return state.items;
        },
        footer(state) {
            return state.footer;
        }
    },
    mutations: {
        setPageTransition(state, data) {
            state.preferences.pageTransition = data;
            savePreferences(state.preferences);
        },
        setCardHeaderColor(state, data) {
            state.preferences.cardHeaderColor = data;
            savePreferences(state.preferences);
        },
        changeDark(state) {
            state.preferences.dark = !state.preferences.dark;
            savePreferences(state.preferences);
        },
        setCardHeaderTextColor(state, data) {
            state.preferences.cardHeaderTextColor = data;
            savePreferences(state.preferences);
        },
        setPreferences(state, data) {
            state.preferences = data;
        },
    },
    actions: {
        setPageTransition(store, data) {
           store.commit('setPageTransition', data);
        },
        setCardHeaderColor(store, data) {
            store.commit('setCardHeaderColor', data);

        },
        setCardHeaderTextColor(store, data) {
            store.commit('setCardHeaderTextColor', data);
        },
        changeDark(store) {
            store.commit('changeDark');
        },
        initPreferences(store) {
            axios({
                method:'post',
                url: '/api/load-preferences',
                responseType: 'json'
            }).then((response) => {

                if(!response.data.empty)
                store.commit('setPreferences', response.data);
            }).catch(error => console.log(error));
        }
    }
}

