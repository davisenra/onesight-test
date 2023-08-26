<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useTaskStore } from '@/stores/tasks';
import { computed, onMounted, ref } from 'vue';
import TaskCard from '@/components/Task/TaskCard.vue';
import TaskList from '@/components/Task/TaskList.vue';

const taskStore = useTaskStore();

const tasks = ref([]);

const pendingTasks = computed(() => {
    return tasks.value.filter((task) => task.status === 'pending');
});

const finishedTasks = computed(() => {
    return tasks.value.filter((task) => task.status === 'done');
});

onMounted(async () => {
    tasks.value = await taskStore.fetchTasks();
});
</script>

<template>
    <AppLayout>
        <div class="bg-base-200 rounded-t-box -mt-4 flex-grow">
            <div class="container mx-auto mt-6 rounded-md bg-white px-6 py-8 shadow">
                <h2 class="prose prose-2xl font-bold">Tasks</h2>
                <p class="prose prose-lg font-bold">Pending tasks</p>
                <TaskList>
                    <TaskCard :task="task" v-for="task in pendingTasks" :key="task.id" />
                </TaskList>
                <div class="divider"></div>
                <p class="prose prose-lg font-bold">Finished tasks</p>
                <TaskList>
                    <TaskCard :task="task" v-for="task in finishedTasks" :key="task.id" />
                </TaskList>
            </div>
        </div>
    </AppLayout>
</template>
