<script setup>
import { computed, ref } from 'vue';
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();

const credentials = ref({
    email: '',
    password: '',
    rememberMe: false
});

const credentialsFilled = computed(() => {
    return credentials.value.email.indexOf('@') && credentials.value.password.length;
});

const isLoading = ref(false);

async function handleLogin() {
    isLoading.value = true;
    try {
        await authStore.login(credentials.value);
    } catch (err) {
        console.log(err);
    }
    isLoading.value = false;
}
</script>

<template>
    <div>
        <form @submit.prevent="handleLogin">
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input
                    v-model="credentials.email"
                    type="text"
                    placeholder="Email"
                    class="input input-bordered"
                />
            </div>
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">Password</span>
                </label>
                <input
                    v-model="credentials.password"
                    type="password"
                    class="input input-bordered"
                />
            </div>
            <div class="form-control w-full max-w-sm">
                <label class="label cursor-pointer">
                    <span class="label-text">Remember me</span>
                    <input
                        v-model="credentials.rememberMe"
                        type="checkbox"
                        checked="checked"
                        class="checkbox"
                    />
                </label>
            </div>
            <button
                class="btn btn-success btn-wide mt-6"
                :disabled="!credentialsFilled"
                type="submit"
            >
                <span v-if="!isLoading">Login</span>
                <span v-else class="loading loading-spinner"></span>
            </button>
        </form>
    </div>
</template>
