<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import CreateTaskForm from '@/components/Task/CreateTaskForm.vue';
</script>

<template>
    <AppLayout>
        <div class="rounded-t-box -mt-4 flex-grow bg-base-200">
            <div class="container mx-auto mt-6 rounded-md bg-white px-6 py-8 shadow">
                <h2 class="prose prose-2xl font-bold">New task</h2>
                <div class="divider"></div>
                <CreateTaskForm />
            </div>
        </div>
    </AppLayout>
</template>
