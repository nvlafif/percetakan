<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'sku' => $this->faker->unique()->bothify('SKU-####'),
            'category' => $this->faker->randomElement(['kertas', 'tinta', 'perlengkapan', 'jasa']),
            'description' => $this->faker->paragraph(),
            'stock' => $this->faker->numberBetween(10, 500),
            'min_stock' => $this->faker->numberBetween(5, 20),
            'unit_cost' => $this->faker->randomFloat(2, 1000, 50000),
            'unit_price' => $this->faker->randomFloat(2, 2000, 75000),
            'status' => 'active',
        ];
    }
}