<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Http\Resources\CartResource;
use App\Actions\Cart\AddToCartAction;
use App\Actions\Cart\RemoveFromCartAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $cartItems = Cart::where('user_id', $request->user()->id)
            ->with('product')
            ->get();

        return response()->json(CartResource::collection($cartItems), 200);
    }

    public function store(Request $request, Product $product, AddToCartAction $action): JsonResponse
    {
        $action->execute($request->user()->id, $product->id);

        return response()->json([
            'message' => 'Product add to card',
        ], 201);
    }

    public function destroy(Request $request, Cart $cart, RemoveFromCartAction $action): JsonResponse
    {
        $action->execute($request->user()->id, $cart);

        return response()->json([
            'message' => 'Item removed from cart',
        ], 200);
    }
}
