<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductVariantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductVariant::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $sizes = [
            ["volume" => 50, "price" => 59.99],
            ["volume" => 100, "price" => 99.99],
            ["volume" => 200, "price" => 179.99],
        ];
        $size = fake()->randomElement($sizes);

        // 30% chance of being on sale
        $onSale = fake()->boolean(30);
        $salePrice = $onSale
            ? round($size["price"] * fake()->randomFloat(2, 0.7, 0.95), 2)
            : null;

        return [
            "name" => "{$size["volume"]}ml",
            "sku" =>
                "PRF-" .
                fake()->unique()->numberBetween(100, 999) .
                "-{$size["volume"]}ML",
            "price" => $size["price"],
            "sale_price" => $salePrice,
            "volume_ml" => $size["volume"],
            "product_id" => Product::factory(),
        ];
    }
}
