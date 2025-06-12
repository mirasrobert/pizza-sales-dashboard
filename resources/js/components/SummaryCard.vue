<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card';

interface Props {
    title: string;
    value?: string;
}

defineProps<Props>();
</script>

<template>
    <Card class="size-full py-6.5">
        <CardContent>
            <div class="size-full items-center">
                <div class="flex items-center justify-between">
                    <h3 class="mb-2 text-sm font-medium tracking-tight">{{ title }}</h3>
                    <div class="opacity-50">
                        <slot></slot>
                    </div>
                </div>

                <div class="text-2xl font-bold">{{ value }}</div>
            </div>
        </CardContent>
    </Card>
</template>
