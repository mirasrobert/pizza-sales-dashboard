<script setup lang="ts">
import BarChart from '@/components/BarChart.vue';
import BankNote from '@/components/icons/BankNote.vue';
import Box from '@/components/icons/Box.vue';
import Cash from '@/components/icons/Cash.vue';
import Chart from '@/components/icons/Chart.vue';
import RecentSales from '@/components/RecentSales.vue';
import SummaryCard from '@/components/SummaryCard.vue';
import TopPizzaTable from '@/components/TopPizza.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type SaleSummary, type TopPizza } from '@/types';
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';

const monthlySales = ref([]);
const salesSummary = ref<SaleSummary>();
const recentSales = ref([]);
const topPizzas = ref<TopPizza[]>([]);

const formatCurrency = computed(() => {
    return (value: any) =>
        new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        }).format(value);
});

const formatNumber = computed(() => {
    return (value: any) =>
        new Intl.NumberFormat('en-US', {
            maximumFractionDigits: 0,
        }).format(value);
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

onMounted(async () => {
    const { data: salesByMonthRes } = await axios.get('/api/v1/analytics/sales-by-month');
    const { data: salesSummaryRes } = await axios.get('/api/v1/analytics/sales-summary');
    const { data: recentSalesRes } = await axios.get('/api/v1/analytics/recent-sales');
    const { data: topPizzasRes } = await axios.get('/api/v1/analytics/top-pizzas');

    salesSummary.value = salesSummaryRes;
    monthlySales.value = salesByMonthRes;
    recentSales.value = recentSalesRes;
    topPizzas.value = topPizzasRes;
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div v-if="salesSummary" class="grid auto-rows-min gap-4 md:grid-cols-4">
                <div>
                    <SummaryCard title="Total Revenue" :value="formatCurrency(salesSummary.total_revenue)">
                        <Cash />
                    </SummaryCard>
                </div>
                <div>
                    <SummaryCard title="Total Pizza's Sold" :value="formatNumber(salesSummary.total_pizzas_sold)">
                        <BankNote />
                    </SummaryCard>
                </div>
                <div>
                    <SummaryCard title="Total Orders" :value="formatNumber(salesSummary.total_orders)">
                        <Box />
                    </SummaryCard>
                </div>
                <div>
                    <SummaryCard title="Avg. Orders Per Month" :value="formatNumber(salesSummary.average_order_per_month)">
                        <Chart />
                    </SummaryCard>
                </div>

                <!-- <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div> -->
            </div>
            <div class="">
                <BarChart v-if="monthlySales.length > 0" :salesData="monthlySales" />
            </div>
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="size-full">
                    <RecentSales v-if="recentSales.length > 0" :recentSales="recentSales" />
                </div>
                <div class="size-full">
                    <TopPizzaTable v-if="topPizzas.length > 0" :topPizzas="topPizzas" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
