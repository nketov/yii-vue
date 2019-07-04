export default {
    namespaced: true,
    state: {
        items: [
            {
                url: '/login',
                text: 'Login'
            },
            {
                url: '/about',
                text: 'About'
            },
            {
                url: '/products',
                text: 'Products List'
            },
            {
                url: '/cart',
                text: 'Your Cart'
            },
            {
                url: '/checkout',
                text: 'Order Now'
            }
        ],
        footer: [
            'Home',
            'About Us',
            'Team',
            'Services',
            'Blog',
            'Contact Us'
        ]
    },
    getters: {
        items(state) {
            return state.items;
        },
        footer(state) {
            return state.footer;
        }
    }
};