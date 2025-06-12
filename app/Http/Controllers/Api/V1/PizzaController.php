<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Pizza;
use Illuminate\Http\Request;
use App\Services\V1\PizzaService;
use App\Http\Controllers\Controller;
use App\Utilities\HttpCode;

class PizzaController extends Controller
{
    protected PizzaService $pizzaService;

    public function __construct(PizzaService $pizzaService)
    {
        $this->pizzaService = $pizzaService;
    }

    public function index()
    {
        return response()->json($this->pizzaService->getAllPizzas(), HttpCode::OK);
    }

    public function show($id)
    {
        return response()->json($this->pizzaService->getPizzaById($id), HttpCode::OK);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pizza_type_id' => 'required|string|exists:pizza_types,id',
            'size' => 'required|string|in:S,M,L,XL,XXL',
            'price' => 'required|numeric|min:0',
        ]);

        return response()->json($this->pizzaService->createPizza($data), HttpCode::CREATED);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'pizza_type_id' => 'sometimes|string|exists:pizza_types,id',
            'size' => 'sometimes|string|in:S,M,L,XL,XXL',
            'price' => 'sometimes|numeric|min:0',
        ]);

        return response()->json($this->pizzaService->updatePizza($id, $data));
    }

    public function destroy($id)
    {
        $this->pizzaService->deletePizza($id);
        return response()->noContent();
    }
}
