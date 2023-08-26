<script setup>
import { Icon } from '@iconify/vue';
</script>

<template>
    <router-link to="/tasks/new" class="btn btn-ghost rounded-btn text-primary-content">
        <Icon icon="ph:plus-circle-bold" class="mt-0.5 text-2xl" />
        <span class="hidden text-xl md:block">New task</span>
    </router-link>
</template>
