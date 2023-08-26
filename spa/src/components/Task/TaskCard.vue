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
        class="hover:bg-base-200 group cursor-pointer rounded-md border border-l-4 shadow transition-all"
        :class="[task.status === 'pending' ? 'border-l-warning' : 'border-l-success']"
    >
        <div class="p-3">
            <span
                class="prose prose-lg font-bold"
                :class="[task.status === 'done' ? 'line-through' : '']"
            >
                {{ task.title }}
            </span>
        </div>
    </router-link>
</template>
