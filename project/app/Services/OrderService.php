<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function checkout(User $user): Order
    {
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => ['Ваша корзина пуста!']
            ]);
        }

        $totalPrice = $cartItems->sum(fn(Cart $item) => $item->product->price);

        return DB::transaction(function () use ($user, $cartItems, $totalPrice) {
            $order = Order::create([
                'user_id' => $user->id,
                'order_price' => $totalPrice,
            ]);


            $productIds = $cartItems->pluck('product_id')->toArray();
            $order->products()->attach($productIds);

            Cart::where('user_id', $user->id)->delete();

            return $order;
        });
    }
}
