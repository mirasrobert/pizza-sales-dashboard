<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\V1\OrderService;
use App\Utilities\HttpCode;

class OrderController extends Controller
{
    protected OrderService $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        return response()->json($this->orderService->paginatedList($perPage), HttpCode::OK);
    }

    public function show($id)
    {
        $order = $this->orderService->findById($id);

        if ($order) {
            $order->load('orderDetails.pizza');
            return response()->json($order);
        }

        return response()->json(['error' => 'Not found'], HttpCode::NOT_FOUND);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required'
        ]);

        $order = $this->orderService->create($validated);
        return response()->json($order, HttpCode::CREATED);
    }

    public function destroy($id)
    {
        $order = $this->orderService->findById($id);
        if (!$order) {
            return response()->json(['error' => 'Not found'], HttpCode::NOT_FOUND);
        }

        $this->orderService->delete($id);
        return response()->json(['deleted' => $id], HttpCode::OK);
    }
}
