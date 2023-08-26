<script setup>
defineProps({
    task: {
        required: true,
        type: Object
    }
});
</script>

<template>
    <router-link
        :to="'/tasks/' + task.id"
        class="group cursor-pointer rounded-md border border-l-4 shadow transition-all hover:bg-base-200"
        :class="[task.status === 'pending' ? 'border-l-warning' : 'border-l-success']"
    >
        <div class="flex items-center justify-between p-3">
            <span
                class="prose prose-lg font-bold"
                :class="[task.status === 'done' ? 'line-through' : '']"
            >
                {{ task.title }}
            </span>
            <span class="text-opacity-20">#{{ task.id }}</span>
        </div>
    </router-link>
</template>
