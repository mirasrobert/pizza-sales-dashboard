<script setup lang="ts">
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import axios from 'axios';
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

const router = useRouter();

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

onMounted(async () => {
    try {
        // Check if user is authenticated
        const { data } = await axios.get('/api/user');
        if (!data) {
            router.push({ name: 'login' });
        }
    } catch (error) {
        router.push({ name: 'login' });
    }
});
</script>

<template>
    <AppSidebarLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppSidebarLayout>
</template>
