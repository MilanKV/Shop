import { createRouter, createWebHistory } from 'vue-router'
import Default from '../layout/Default.vue'
import Home from '../views/Home.vue'

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
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
  
export default router;