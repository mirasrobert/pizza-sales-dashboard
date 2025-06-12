<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AnalyticsRepositoryInterface;

class AnalyticsController extends Controller
{
    protected AnalyticsRepositoryInterface $analytics;

    public function __construct(AnalyticsRepositoryInterface $analytics)
    {
        $this->analytics = $analytics;
    }

    public function salesSummary()
    {
        return response()->json($this->analytics->getSalesSummary());
    }

    public function topPizzas()
    {
        return response()->json($this->analytics->getTopPizzas());
    }

    public function salesByDate(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        return response()->json(
            $this->analytics->getSalesByDate($request->from, $request->to)
        );
    }

    public function recentSales()
    {
        return response()->json($this->analytics->getRecentSales());
    }
}
