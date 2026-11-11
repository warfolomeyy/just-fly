<?php

namespace App\Actions\Product;

use App\Models\Product;

class CreateProductAction
{
    public function execute(array $data): Product {
        return Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
        ]);
    }

}
