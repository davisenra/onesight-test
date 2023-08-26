import { defineStore } from 'pinia';
import { useApiFetch } from '@/composables/useApiFetch';

export const useDashboardStore = defineStore('dashboard', () => {
    async function fetchDashboardData() {
        const res = await useApiFetch('/v1/dashboard');

        if (!res.ok) {
            throw Error('Erro while fetching dashboard data');
        }

        return await res.json();
    }

    return { fetchDashboardData };
});
