<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\NewsletterSubscriber;

class NewsletterSubscriberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NewsletterSubscriber::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            "email" => fake()->unique()->safeEmail(),
            "is_active" => fake()->boolean(),
            "unsubscribed_at" => fake()->optional()->dateTime(),
        ];
    }
}
