import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '@/stores/auth';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            name: 'dashboard',
            path: '/',
            component: () => import('@/views/DashboardView.vue')
        },
        {
            name: 'tasks',
            path: '/tasks',
            component: () => import('@/views/TasksView.vue')
        },
        {
            name: 'task_show',
            path: '/tasks/:id',
            component: () => import('@/views/TaskView.vue')
        },
        {
            name: 'tasks_create',
            path: '/tasks/new',
            component: () => import('@/views/CreateTaskView.vue')
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

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();
    const isAuthenticated = authStore.isAuthenticated;

    if (!['login', 'register'].includes(to.name) && !isAuthenticated) {
        next({ name: 'login' });
        return;
    }

    if (['login', 'register'].includes(to.name) && isAuthenticated) {
        next({ name: 'dashboard' });
        return;
    }

    next();
});

export default router;
