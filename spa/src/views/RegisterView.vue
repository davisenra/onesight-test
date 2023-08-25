<script setup>
import GuestLayout from '@/layouts/GuestLayout.vue';
import RegisterForm from '@/components/Auth/RegisterForm.vue';
import TaskManagerLogo from '@/components/Core/TaskManagerLogo.vue';
</script>

<template>
    <GuestLayout class="space-y-3">
        <div
            class="flex w-full max-w-sm flex-col items-center justify-center rounded-md bg-white px-6 py-8 shadow-md md:max-w-lg"
        >
            <TaskManagerLogo />
            <div class="divider"></div>
            <RegisterForm />
            <div class="mt-6 text-center">
                <p class="prose">Already registered?</p>
                <router-link to="login" class="hover:link">Click here to login</router-link>
            </div>
        </div>
    </GuestLayout>
</template>
