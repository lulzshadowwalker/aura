<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Review;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'rating' => fake()->numberBetween(-10000, 10000),
            'content' => fake()->paragraphs(3, true),
            'product_id' => Product::factory(),
            'customer_id' => Customer::factory(),
        ];
    }
}
