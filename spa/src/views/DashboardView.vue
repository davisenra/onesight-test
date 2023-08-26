<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { onMounted, ref } from 'vue';
import { useDashboardStore } from '@/stores/dashboard';
import { Pie } from 'vue-chartjs';

const dashboardStore = useDashboardStore();
const dashboardData = ref({});
const dataFetched = ref(false);

const pieChartData = ref({});

onMounted(async () => {
    try {
        dashboardData.value = await dashboardStore.fetchDashboardData();
        dataFetched.value = true;

        pieChartData.value = {
            labels: ['Pending', 'Done'],
            datasets: [
                {
                    backgroundColor: ['#36d399', '#fbbd23'],
                    data: [
                        dashboardData.value.metadata.pendingTasks,
                        dashboardData.value.metadata.finishedTasks
                    ]
                }
            ]
        };
    } catch (err) {
        console.log(err);
    }
});
</script>

<template>
    <AppLayout>
        <div class="rounded-t-box -mt-4 flex-grow bg-base-200">
            <div class="container mx-auto mt-6 rounded-md bg-white px-6 py-8 shadow">
                <h2 class="prose prose-2xl font-bold">Dashboard</h2>
                <div class="divider"></div>
                <div v-if="dataFetched">
                    <p class="prose prose-xl my-3 font-bold">
                        Welcome back, {{ dashboardData.user.email }}!
                    </p>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                        <div
                            class="flex flex-col items-center justify-center rounded-md border border-opacity-20 p-4 shadow-md"
                        >
                            <p class="prose prose-xl font-bold">Total tasks</p>
                            <p class="text-6xl font-extrabold text-primary">
                                {{ dashboardData.metadata.totalTasks }}
                            </p>
                        </div>
                        <div
                            class="flex flex-col items-center justify-center rounded-md border border-opacity-20 p-4 shadow-md"
                        >
                            <p class="prose prose-xl font-bold">Created this week</p>
                            <p class="text-6xl font-extrabold text-accent">
                                {{ dashboardData.metadata.createdThisWeek }}
                            </p>
                        </div>
                        <div
                            class="flex flex-col items-center justify-center rounded-md border border-opacity-20 p-4 shadow-md"
                        >
                            <p class="prose prose-xl font-bold">Pending tasks</p>
                            <p class="text-6xl font-extrabold text-warning">
                                {{ dashboardData.metadata.pendingTasks }}
                            </p>
                        </div>
                        <div
                            class="flex flex-col items-center justify-center rounded-md border border-opacity-20 p-4 shadow-md md:col-span-2 xl:md:col-span-2"
                        >
                            <p class="prose prose-xl font-bold">Tasks</p>
                            <Pie
                                v-if="dashboardData.metadata.totalTasks > 0"
                                :data="pieChartData"
                                :options="{ responsive: false }"
                            />
                            <p v-else class="prose prose-xl">You currently have no tasks</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
