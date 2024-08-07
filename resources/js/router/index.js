import { createRouter, createWebHistory } from 'vue-router'
import Default from '../layout/Default.vue'
import Home from '../views/Home.vue'
import Shop from '../views/Shop.vue'
import About from '../views/About.vue'
import Contact from '../views/Contact.vue'
import ProductDetails from '../views/ProductDetails.vue'

const routes = [
    {
        path: '/',
        name: 'Default',
        component: Default,
        children: [
            {
                path: '',
                name: 'Home',
                component: Home
            },
            {
                path: 'shop',
                name: 'Shop',
                component: Shop
            },
            {
                path: 'about',
                name: 'About',
                component: About
            },
            {
                path: 'contact',
                name: 'Contact',
                component: Contact
            },
            {
                path: '/product-details/:id',
                name: 'ProductDetails',
                component: ProductDetails,
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { top: 0 };
        }
    }
});

export default router;