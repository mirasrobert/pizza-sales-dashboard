<?php

namespace App\Http\Controllers\Api\V1;

use App\Utilities\HttpCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\V1\PizzaTypeService;
use Symfony\Component\HttpFoundation\JsonResponse;

class PizzaTypeController extends Controller
{
    protected PizzaTypeService $pizzaTypeService;

    public function __construct(PizzaTypeService $pizzaTypeService)
    {
        $this->pizzaTypeService = $pizzaTypeService;
    }

    public function index(): JsonResponse
    {
        $pizzaTypes = $this->pizzaTypeService->getAll();
        return response()->json($pizzaTypes, HttpCode::OK);
    }

    public function show(string $id): JsonResponse
    {
        $pizzaType = $this->pizzaTypeService->getById($id);

        if (!$pizzaType) {
            return response()->json(['message' => 'Pizza type not found'], HttpCode::NOT_FOUND);
        }

        return response()->json($pizzaType);
    }
}
