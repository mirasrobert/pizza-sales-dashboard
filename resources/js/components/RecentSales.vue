<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card';

defineProps({
    recentSales: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div class="overflow-x-auto rounded-lg shadow">
        <Card class="size-full py-6.5">
            <CardContent>
                <div class="size-full items-center">
                    <div class="flex items-center justify-between">
                        <h3 class="mb-2 text-sm font-medium tracking-tight">Recent Sales</h3>
                    </div>

                    <table class="min-w-full text-left text-sm text-gray-700">
                        <thead class="bg-gray-100 text-xs text-gray-500 uppercase">
                            <tr>
                                <th class="px-4 py-3">Pizza ID</th>
                                <th class="px-4 py-3">Size</th>
                                <th class="px-4 py-3">Price ($)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="sale in recentSales" :key="sale.id" class="border-b">
                                <td class="px-4 py-2">{{ sale.pizza_id }}</td>
                                <td class="px-4 py-2">{{ sale.pizza.size }}</td>
                                <td class="px-4 py-2">{{ Number(sale.pizza.price).toFixed(2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </CardContent>
        </Card>
    </div>
</template>
