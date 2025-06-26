<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cart;

class CartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cart::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $hasCustomer = $this->faker->boolean();

        return [
            "session_id" => !$hasCustomer ? fake()->word() : null,
            "customer_id" => $hasCustomer ? Customer::factory() : null,
        ];
    }
}
