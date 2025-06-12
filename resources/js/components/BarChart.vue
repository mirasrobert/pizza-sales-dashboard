<!-- components/MonthlySalesChart.vue -->
<template>
    <Bar :data="chartData" :options="chartOptions" />
</template>

<script setup lang="ts">
import { BarElement, CategoryScale, Chart as ChartJS, Legend, LinearScale, Title, Tooltip } from 'chart.js';
import { Bar } from 'vue-chartjs';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const props = defineProps({
    salesData: {
        type: Array,
        required: true,
    },
});

// Format chart labels (e.g., "Jan", "Feb", ...)
const labels = props.salesData.map((item) => new Date(item.year, item.month - 1).toLocaleString('default', { month: 'short' }));

// Chart data
const chartData = {
    labels,
    datasets: [
        {
            label: 'Revenue ($)',
            data: props.salesData.map((item) => parseFloat(item.revenue)),
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
        },
        {
            label: 'Pizzas Sold',
            data: props.salesData.map((item) => parseInt(item.total_pizzas)),
            backgroundColor: 'rgba(255, 99, 132, 0.7)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            yAxisID: 'y1',
        },
    ],
};

// Chart options
const chartOptions = {
    responsive: true,
    plugins: {
        title: {
            display: true,
            text: 'Monthly Pizza Sales and Revenue',
        },
    },
    scales: {
        y: {
            beginAtZero: true,
            title: { display: true, text: 'Revenue ($)' },
        },
        y1: {
            beginAtZero: true,
            position: 'right',
            title: { display: true, text: 'Total Pizzas' },
            grid: { drawOnChartArea: false },
        },
    },
};
</script>
