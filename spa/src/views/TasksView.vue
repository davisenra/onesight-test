<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useTaskStore } from '@/stores/tasks';
import { computed, onMounted, ref } from 'vue';
import TaskCard from '@/components/Task/TaskCard.vue';
import TaskList from '@/components/Task/TaskList.vue';

const taskStore = useTaskStore();

const tasks = ref([]);

const filter = ref('');

const filteredTasks = computed(() => {
    return tasks.value.filter((task) => {
        return filter.value
            .toLowerCase()
            .split(' ')
            .every((v) => task.title.toLowerCase().includes(v));
    });
});

const pendingTasks = computed(() => {
    return filteredTasks.value.filter((task) => task.status === 'pending');
});

const finishedTasks = computed(() => {
    return filteredTasks.value.filter((task) => task.status === 'done');
});

onMounted(async () => {
    tasks.value = await taskStore.fetchTasks();
});
</script>

<template>
    <AppLayout>
        <div class="rounded-t-box -mt-4 flex-grow bg-base-200">
            <div class="container mx-auto mt-6 rounded-md bg-white px-6 py-8 shadow">
                <h2 class="prose prose-2xl font-bold">Tasks</h2>
                <p class="prose font-bold">Filters</p>
                <div class="my-2">
                    <input
                        v-model="filter"
                        type="text"
                        placeholder="Filter by name"
                        class="input input-bordered input-sm w-full max-w-xs"
                    />
                </div>
                <div class="divider"></div>
                <div class="flex items-center space-x-3">
                    <p class="prose prose-lg font-bold">Pending tasks</p>
                    <span class="badge badge-accent">
                        {{ pendingTasks.length }}
                    </span>
                </div>
                <TaskList>
                    <TaskCard :task="task" v-for="task in pendingTasks" :key="task.id" />
                </TaskList>
                <div class="divider"></div>
                <div class="flex items-center space-x-3">
                    <p class="prose prose-lg font-bold">Finished tasks</p>
                    <span class="badge badge-accent">
                        {{ finishedTasks.length }}
                    </span>
                </div>
                <TaskList>
                    <TaskCard :task="task" v-for="task in finishedTasks" :key="task.id" />
                </TaskList>
            </div>
        </div>
    </AppLayout>
</template>
