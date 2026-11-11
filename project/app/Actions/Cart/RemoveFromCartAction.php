<?php

namespace app\Actions\Cart;

use App\Models\Cart;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class RemoveFromCartAction
{
    public function execute(int $userId, Cart $cartItem): void {

        if ($cartItem->user_id !== $userId) {
            throw new AccessDeniedHttpException('Forbidden for you');
        }

        $cartItem->delete();

    }
}
