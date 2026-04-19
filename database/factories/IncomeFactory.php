<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    protected $model = \App\Models\Income::class;

    public function definition(): array
    {
        return [
            'category' => $this->faker->randomElement(['printing', 'photocopy', 'design', 'other']),
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->randomFloat(2, 10000, 500000),
            'date' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'reference' => 'INV-' . $this->faker->numerify('####'),
            'status' => 'received',
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}