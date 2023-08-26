<script setup>
import TaskManagerHeader from '@/components/Core/TaskManagerHeader.vue';
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <TaskManagerHeader />
        <slot />
    </div>
</template>
