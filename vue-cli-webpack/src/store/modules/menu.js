export default {
    namespaced: true,
    state: {
        preferences: {
            pageTransition: 'a-slide-x',
            dark: true,
            cardHeaderColor : '#364777',
            cardHeaderTextColor : '#E9D61B',
        },
        items: [
            {
                url: '/about',
                text: 'О сайте',
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
            {
                url: '/checkout',
                text: 'Заказать',
                icon: 'done_outline'
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
            state.preferences.transition = data;
        },
        setCardHeaderColor(state, data) {
            state.preferences.cardHeaderColor = data;
        },
        setCardHeaderTextColor(state, data) {
            state.preferences.cardHeaderTextColor = data;
        }
    },
    actions: {
        setPageTransition(state, data) {
            store.commit(state, data);
        },
        setCardHeaderColor(state, data) {
            store.commit(state, data);
        },
        setCardHeaderTextColor(state, data) {
            store.commit(state, data);
        }
    }
}
