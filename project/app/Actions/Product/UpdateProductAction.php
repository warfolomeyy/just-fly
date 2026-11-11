<?php

namespace App\Actions\Product;

use App\Models\Product;

class UpdateProductAction
{
    public function execute(Product $product, array $data): Product {
        $product->update(array_filter($data, fn($value) => !is_null($value)));

        return $product->fresh();
    }
}
