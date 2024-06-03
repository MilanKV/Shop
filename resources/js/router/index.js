import { createRouter, createWebHistory } from 'vue-router'
import Default from '../layout/Default.vue'
import Home from '../views/Home.vue'
import Shop from '../views/Shop.vue'
import About from '../views/About.vue'
import Contact from '../views/Contact.vue'

const routes = [
    {
        path: '/',
        name: 'Default',
        component:Default,
        children: [
            {
                path: '',
                name: 'Home',
                component:Home
            },
            {
                path: 'shop',
                name: 'Shop',
                component:Shop
            },
            {
                path: 'about',
                name: 'About',
                component:About
            },
            {
                path: 'contact',
                name: 'Contact',
                component:Contact
            },
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
  
export default router;