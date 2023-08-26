<script setup>
import { computed, ref } from 'vue';
import { useTaskStore } from '@/stores/tasks';
import router from '@/router';

const taskStore = useTaskStore();

const task = ref({
    title: '',
    description: ''
});

const isSubmiting = ref(false);

const allowSubmit = computed(() => {
    return task.value.title.length >= 3;
});

async function handleSubmit() {
    isSubmiting.value = true;
    try {
        await taskStore.createTask(task.value);
        await router.push('/tasks');
    } catch (err) {
        console.log(err);
    }
    isSubmiting.value = false;
}
</script>

<template>
    <form @submit.prevent="handleSubmit()">
        <div class="form-control w-full- max-w-lg">
            <label class="label">
                <span class="label-text">Title</span>
            </label>
            <input v-model="task.title" type="text" class="input input-bordered" maxlength="255" />
        </div>
        <div class="form-control w-full- max-w-lg">
            <label class="label">
                <span class="label-text">Description</span>
            </label>
            <textarea
                v-model="task.description"
                class="textarea textarea-bordered"
                maxlength="255"
            />
        </div>
        <button class="btn btn-primary mt-6" :disabled="!allowSubmit">
            <span v-if="isSubmiting" class="loading loading-spinner"></span>
            Create
        </button>
    </form>
</template>
