<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;

class ProductFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            "name" => $this->localized(fn(): string => fake()->word()),
            "slug" => fake()->unique()->slug(),
            "sku" => fake()->unique()->word(),
            "description" => $this->localized(
                fn(): string => fake()->sentence()
            ),
            "is_active" => fake()->boolean(),
            "category_id" => Category::factory(),
        ];
    }
}
