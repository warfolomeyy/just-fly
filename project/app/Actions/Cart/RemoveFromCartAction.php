<?php

namespace App\Actions\Cart;

use App\Models\Cart;

class RemoveFromCartAction
{
    public function execute(Cart $cartItem): void
    {
        $cartItem->delete();
    }
}
