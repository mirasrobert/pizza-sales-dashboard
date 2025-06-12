<script setup lang="ts">
import AuthLayout from '@/layouts/auth/AuthCardLayout.vue';
import axios from 'axios';
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';

defineProps<{
    title?: string;
    description?: string;
}>();

// Check if user is guest. api/user should return 401 if not authenticated
onMounted(() => {
    const router = useRouter();
    axios
        .get('/api/user')
        .then(() => {
            // User is authenticated, redirect to dashboard
            router.push({ name: 'dashboard' });
        })
        .catch(() => {
            // User is not authenticated, stay on the login page
        });
});
</script>

<template>
    <AuthLayout :title="title" :description="description">
        <slot />
    </AuthLayout>
</template>
