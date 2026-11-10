<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'SU-100 Москва Сочи',
                'description' => 'Рейс SU-100, Вылет 12:00, Эконом класс',
                'price' => 8500.00,
            ],
            [
                'name' => 'SU-202 Москва Санкт-Петербург',
                'description' => 'Рейс SU-202, Вылет 15:30, Эконом класс',
                'price' => 4200.00,
            ],
            [
                'name' => 'SU-303 Москва Казань',
                'description' => 'Рейс SU-303, Вылет 18:00, Эконом класс',
                'price' => 3500,

            ]
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                [
                    'description' => $product['description'],
                    'price' => $product['price'],
                ]
            );
        }
    }
}
