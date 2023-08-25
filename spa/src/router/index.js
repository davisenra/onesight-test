import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            name: 'dashboard',
            path: '/',
            component: () => import('@/views/DashboardView.vue')
        },
        {
            name: 'login',
            path: '/login',
            component: () => import('@/views/LoginView.vue')
        },
        {
            name: 'register',
            path: '/register',
            component: () => import('@/views/RegisterView.vue')
        }
    ]
});

export default router;
