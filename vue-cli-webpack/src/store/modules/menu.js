export default {
    namespaced: true,
    state: {
        items: [
            {
                url: '/login',
                text: 'Вход',
                icon: 'input'
            },
            {
                url: '/about',
                text: 'О нас',
                icon: 'info'
            },
            {
                url: '/products',
                text: 'Магазин',
                icon: 'view_list'
            },
            {
                url: '/cart',
                text: 'Корзина',
                icon: 'shopping_cart'
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
                    'About Us',
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
        items(state) {
            return state.items;
        },
        footer(state) {
            return state.footer;
        }
    }
}
;