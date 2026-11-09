<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable = ['user_id', 'order_price'];

    public function user() {
        return $this->belongsTo(User::class); // Заказ принадлежит пользователю
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_product'); // Билеты в заказе
    }
}
