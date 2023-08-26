<script setup>
import TaskManagerLogo from '@/components/Core/TaskManagerLogo.vue';
import TaskManagerHeaderMenu from '@/components/Core/TaskManagerHeaderMenu.vue';
import CreateTaskButton from '@/components/Task/CreateTaskButton.vue';
</script>

<template>
    <header class="bg-primary pb-8 pt-4">
        <div class="flex items-center justify-between px-3">
            <TaskManagerHeaderMenu />
            <TaskManagerLogo class="text-primary-content text-2xl" />
            <CreateTaskButton />
        </div>
    </header>
</template>
