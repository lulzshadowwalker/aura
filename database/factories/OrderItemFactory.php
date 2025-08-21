<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $sizes = [50, 100, 200];
        $size = fake()->randomElement($sizes);
        $quantity = fake()->numberBetween(1, 3);
        $unitPrice = match ($size) {
            50 => 59.99,
            100 => 99.99,
            200 => 179.99,
            default => 99.99,
        };
        $subtotal = round($quantity * $unitPrice, 2);

        return [
            "product_name" => "Perfume",
            "quantity" => $quantity,
            "unit_price" => $unitPrice,
            "subtotal" => $subtotal,
            "total" => $subtotal,
            "order_id" => Order::factory(),
            "product_id" => Product::factory(),
        ];
    }
}
