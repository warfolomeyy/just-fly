<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->with('products')
            ->get();

        return response()->json(OrderResource::collection($orders), 200);
    }

    public function store(Request $request, OrderService $orderService): JsonResponse
    {
        $order = $orderService->checkout($request->user());

        return response()->json([
            'order_id' => $order->id,
            'message' => 'Order is processed',
        ], 201);
    }
}
