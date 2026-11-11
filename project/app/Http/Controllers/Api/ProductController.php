<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Actions\Product\CreateProductAction;
use App\Actions\Product\UpdateProductAction;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json(ProductResource::collection($products), 200);
    }

    public function store(StoreProductRequest $request, CreateProductAction $action): JsonResponse
    {
        $product = $action->execute($request->validated());

        return response()->json([
            'id' => $product->id,
            'message' => 'Product added',
        ], 201);
    }

    public function update(
        UpdateProductRequest $request,
        Product $product,
        UpdateProductAction $action
    ): JsonResponse {
        $updated = $action->execute($product, $request->validated());

        return response()->json(new ProductResource($updated), 200);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'message' => 'Product removed',
        ], 200);
    }
}
