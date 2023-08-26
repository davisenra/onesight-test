<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();

const registration = ref({
    email: '',
    password: ''
});

const isLoading = ref(false);

async function handleRegistration() {
    isLoading.value = true;
    try {
        await authStore.register(registration.value);
    } catch (err) {
        console.log(err);
    }
    isLoading.value = false;
}
</script>

<template>
    <div>
        <form @submit.prevent="handleRegistration">
            <!--            <div class="form-control w-full max-w-sm">-->
            <!--                <label class="label">-->
            <!--                    <span class="label-text">Name</span>-->
            <!--                </label>-->
            <!--                <input type="text" class="input input-bordered" />-->
            <!--            </div>-->
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input v-model="registration.email" type="text" class="input input-bordered" />
            </div>
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">Password</span>
                </label>
                <input
                    v-model="registration.password"
                    type="password"
                    class="input input-bordered"
                />
            </div>
            <button class="btn btn-success btn-wide mt-6" type="submit">
                <span v-if="!isLoading">Register</span>
                <span v-else class="loading loading-spinner"></span>
            </button>
        </form>
    </div>
</template>
