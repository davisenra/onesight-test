import { defineStore } from 'pinia';
import { useApiFetch } from '@/composables/useApiFetch';

export const useTaskStore = defineStore('tasks', () => {
    /**
     * @param {number} taskId
     * @returns {Promise<void>}
     */
    async function fetchTaskById(taskId) {
        const res = await useApiFetch(`/v1/tasks/${taskId}`);

        if (!res.ok) {
            throw new Error('Error while fetching task from server');
        }

        const { data: task } = await res.json();

        return task;
    }

    async function fetchTasks() {
        const res = await useApiFetch('/v1/tasks');

        if (!res.ok) {
            throw new Error('Error while fetching tasks from server');
        }

        const { data: tasks } = await res.json();

        return tasks;
    }

    async function toggleTaskStatus(taskId) {
        const res = await useApiFetch(`/v1/tasks/${taskId}/done`, {
            method: 'PUT'
        });

        if (!res.ok) {
            throw new Error('Error while fetching tasks from server');
        }
    }

    async function deleteTask(taskId) {
        const res = await useApiFetch(`/v1/tasks/${taskId}`, {
            method: 'DELETE'
        });

        if (!res.ok) {
            throw new Error('Error while deleting task from server');
        }
    }

    /**
     * @param {string} title
     * @param {string|null} description
     * @returns {Promise<void>}
     */
    async function createTask({ title, description = null }) {
        const payload = {
            title: title,
            description: description === '' ? null : description
        };

        const res = await useApiFetch('/v1/tasks', {
            method: 'POST',
            body: JSON.stringify(payload)
        });

        if (!res.ok) {
            throw new Error('Error while creating the task');
        }

        const { status } = await res.json();

        if (!status) {
            throw new Error('Invalid task');
        }
    }

    return { fetchTaskById, fetchTasks, createTask, deleteTask, toggleTaskStatus };
});
