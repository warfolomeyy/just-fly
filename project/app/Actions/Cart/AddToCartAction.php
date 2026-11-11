<?php

namespace app\Actions\Cart;
use App\Models\Cart;

class AddToCartAction
{
    public function execute(int $userId, int $productId){
        return Cart::create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);
    }
}
