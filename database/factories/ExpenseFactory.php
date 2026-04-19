<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    protected $model = \App\Models\Expense::class;

    public function definition(): array
    {
        return [
            'category' => $this->faker->randomElement(['supplies', 'utility', 'rent', 'salary', 'maintenance', 'other']),
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->randomFloat(2, 5000, 1000000),
            'date' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'reference' => 'EXP-' . $this->faker->numerify('####'),
            'status' => 'paid',
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}