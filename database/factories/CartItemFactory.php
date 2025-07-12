<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CartItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            "quantity" => fake()->numberBetween(1, 5),
            "cart_id" => Cart::factory(),
            "product_id" => Product::factory(),
        ];
    }
}
