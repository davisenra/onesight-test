import { defineStore } from 'pinia';
import { useApiFetch } from '@/composables/useApiFetch';
import router from '@/router';
import { ref } from 'vue';

export const useAuthStore = defineStore(
    'auth',
    () => {
        const isAuthenticated = ref(false);

        /**
         * @param {string} email
         * @param {string} password
         * @param {boolean} rememberMe
         * @returns {Promise<void>}
         */
        async function login({ email, password, rememberMe }) {
            const payload = {
                email: email,
                password: password,
                _remember_me: !!rememberMe
            };

            const res = await useApiFetch('/login', {
                method: 'POST',
                body: JSON.stringify(payload)
            });

            if (!res.ok) {
                throw Error('Authetication failed');
            }

            isAuthenticated.value = true;

            await router.push('/');
        }

        async function logout() {
            await useApiFetch('/logout', {
                method: 'POST'
            });

            isAuthenticated.value = false;

            await router.push('/login');
        }

        return {
            isAuthenticated,
            login,
            logout
        };
    },
    {
        persist: {
            storage: localStorage
        }
    }
);
