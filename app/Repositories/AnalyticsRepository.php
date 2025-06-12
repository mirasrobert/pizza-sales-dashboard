<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use App\Repositories\AnalyticsRepositoryInterface;

class AnalyticsRepository implements AnalyticsRepositoryInterface
{
    public function getSalesSummary(): array
    {
        $totalRevenue = OrderDetail::join('pizzas', 'order_details.pizza_id', '=', 'pizzas.id')
            ->select(DB::raw('SUM(order_details.quantity * pizzas.price) as total'))
            ->value('total');

        $totalSold = OrderDetail::sum('quantity');
        $totalOrders = OrderDetail::distinct('order_id')->count('order_id');
        $averageOrderPerMonth = Order::selectRaw('COUNT(*) / COUNT(DISTINCT MONTH(date)) as avg_orders')
        ->value('avg_orders');

        return [
            'total_revenue' => $totalRevenue,
            'total_pizzas_sold' => $totalSold,
            'total_orders' => $totalOrders,
            'average_order_per_month' => $averageOrderPerMonth
        ];
    }

    public function getTopPizzas(int $limit = 10): array
    {
        return OrderDetail::select('pizza_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('pizza_id')
            ->orderByDesc('total_quantity')
            ->with('pizza')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    public function getSalesByDate(string $from, string $to): array
    {
        return OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('pizzas', 'order_details.pizza_id', '=', 'pizzas.id')
            ->whereBetween('orders.date', [$from, $to])
            ->groupBy('orders.date')
            ->orderBy('orders.date')
            ->select(
                'orders.date',
                DB::raw('SUM(order_details.quantity * pizzas.price) as revenue'),
                DB::raw('SUM(order_details.quantity) as total_pizzas')
            )
            ->get()
            ->toArray();
    }

    public function getSalesByMonth(string $year = '2015'): array
    {
        return OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('pizzas', 'order_details.pizza_id', '=', 'pizzas.id')
            ->whereYear('orders.date', $year)
            ->groupBy(
                DB::raw('YEAR(orders.date)'),
                DB::raw('MONTH(orders.date)')
            )
            ->orderBy(DB::raw('MONTH(orders.date)'))
            ->select(
                DB::raw('MONTH(orders.date) as month'),
                DB::raw('YEAR(orders.date) as year'),
                DB::raw('SUM(order_details.quantity * pizzas.price) as revenue'),
                DB::raw('SUM(order_details.quantity) as total_pizzas')
            )
            ->get()
            ->toArray();
    }

    public function getRecentSales(int $limit = 10): array
    {
        return OrderDetail::with(['order', 'pizza'])
            ->latest('order_id')
            ->limit($limit)
            ->get()
            ->toArray();
    }
}
