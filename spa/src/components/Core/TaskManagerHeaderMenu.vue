<script setup>
import { Icon } from '@iconify/vue';
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();
</script>

<template>
    <div class="dropdown dropdown-start">
        <label tabindex="0" class="btn btn-ghost rounded-btn">
            <Icon icon="ph:list-bold" class="text-primary-content text-2xl" />
        </label>
        <ul
            tabindex="0"
            class="menu dropdown-content rounded-box text-md z-[1] mt-4 w-52 bg-white p-2 shadow-md"
        >
            <li>
                <router-link to="/">
                    <Icon icon="material-symbols:dashboard-rounded" />
                    Dashboard
                </router-link>
            </li>
            <li>
                <router-link to="/tasks">
                    <Icon icon="fluent:tasks-app-24-regular" />
                    Tasks
                </router-link>
            </li>
            <li>
                <a @click="authStore.logout">
                    <Icon icon="ph:sign-out" />
                    Logout
                </a>
            </li>
        </ul>
    </div>
</template>
