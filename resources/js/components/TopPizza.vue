<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card';
import { type TopPizza } from '@/types';

defineProps({
    topPizzas: {
        type: Array as () => TopPizza[],
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
                        <h3 class="mb-2 text-sm font-medium tracking-tight">Top Pizza</h3>
                    </div>

                    <table class="min-w-full text-left text-sm text-gray-700">
                        <thead class="bg-gray-100 text-xs text-gray-500 uppercase">
                            <tr>
                                <th class="px-4 py-3">Pizza ID</th>
                                <th class="px-4 py-3">Size</th>
                                <th class="px-4 py-3">Total Orders</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pizza in topPizzas" :key="pizza.pizza_id" class="border-b">
                                <td class="px-4 py-2">{{ pizza.pizza_id }}</td>
                                <td class="px-4 py-2">{{ pizza.pizza.size }}</td>
                                <td class="px-4 py-2">{{ Number(pizza.total_quantity).toLocaleString() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </CardContent>
        </Card>
    </div>
</template>

<style scoped></style>
