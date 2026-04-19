<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockInFactory extends Factory
{
    protected $model = \App\Models\StockIn::class;

    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(10, 100);
        $unitCost = $this->faker->randomFloat(2, 5000, 50000);

        return [
            'product_id' => Product::inRandomOrder()->first()?->id ?? 1,
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
            'total_cost' => $quantity * $unitCost,
            'supplier' => $this->faker->company(),
            'reference_number' => 'PO-' . $this->faker->numerify('####'),
            'date' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}