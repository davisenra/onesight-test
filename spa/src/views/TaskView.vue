<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useRoute } from 'vue-router';
import { onMounted, ref } from 'vue';
import { useTaskStore } from '@/stores/tasks';
import { Icon } from '@iconify/vue';

const route = useRoute();
const taskId = route.params.id;

const taskStore = useTaskStore();
const task = ref({});

onMounted(async () => {
    task.value = await taskStore.fetchTaskById(parseInt(taskId.toString()));
});
</script>

<template>
    <AppLayout>
        <div class="bg-base-200 rounded-t-box -mt-4 flex-grow">
            <div
                :class="[task.status === 'pending' ? 'border-l-warning' : 'border-l-success']"
                class="container mx-auto mt-6 rounded-md border-l-4 bg-white px-6 py-8 shadow"
            >
                <h2 class="prose prose-2xl font-bold">#{{ taskId }} {{ task.title }}</h2>
                <p class="prose prose-lg">{{ task.description }}</p>
                <div class="divider"></div>
                <div>
                    <button class="btn btn-wide btn-success">
                        <Icon icon="ion:md-checkbox-outline" class="text-lg" />
                        Mark as finished
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
