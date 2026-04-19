<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockOutFactory extends Factory
{
    protected $model = \App\Models\StockOut::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()?->id ?? 1,
            'quantity' => $this->faker->numberBetween(1, 20),
            'reason' => $this->faker->randomElement(['sale', 'damaged', 'expired', 'returned']),
            'date' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}