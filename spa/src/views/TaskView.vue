<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useRoute } from 'vue-router';
import { computed, onMounted, ref } from 'vue';
import { useTaskStore } from '@/stores/tasks';
import { Icon } from '@iconify/vue';
import { useDateFormatter } from '@/composables/useDateFormatter';
import router from '@/router';

const route = useRoute();
const taskId = route.params.id;

const taskStore = useTaskStore();
const task = ref({});

const createdAt = computed(() => useDateFormatter(task.value.createdAt));

onMounted(async () => {
    task.value = await taskStore.fetchTaskById(parseInt(taskId.toString()));
});

async function handleStatusToggle() {
    try {
        await taskStore.toggleTaskStatus(taskId);
        await router.push('/tasks');
    } catch (err) {
        console.log(err);
    }
}

async function handleDeleteAction() {
    try {
        await taskStore.deleteTask(taskId);
        await router.push('/tasks');
    } catch (err) {
        console.log(err);
    }
}
</script>

<template>
    <AppLayout>
        <div class="rounded-t-box -mt-4 flex-grow bg-base-200 px-3 md:px-0">
            <div
                :class="[task.status === 'pending' ? 'border-l-warning' : 'border-l-success']"
                class="container mx-auto mt-6 rounded-md border-l-4 bg-white px-6 py-8 shadow"
            >
                <router-link to="/tasks" class="btn btn-circle btn-sm mb-3">
                    <Icon icon="ion:arrow-back" />
                </router-link>
                <div class="flex flex-col items-start justify-between lg:flex-row lg:items-center">
                    <h2 class="prose prose-2xl font-bold">#{{ taskId }} {{ task.title }}</h2>
                    <p class="prose italic">Created at: {{ createdAt }}</p>
                </div>
                <div class="my-3 max-w-2xl">
                    <p class="prose prose-lg break-words">
                        {{ task.description }}
                    </p>
                </div>
                <div class="divider"></div>
                <div class="flex space-x-3">
                    <button
                        @click="handleStatusToggle()"
                        v-if="task.status === 'pending'"
                        class="btn btn-success btn-wide"
                    >
                        <Icon icon="ion:md-checkbox-outline" class="text-lg" />
                        Mark as finished
                    </button>
                    <button @click="handleDeleteAction()" class="btn btn-square btn-error">
                        <Icon icon="ion:md-trash" class="text-lg" />
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
