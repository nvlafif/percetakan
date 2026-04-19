<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'position' => $this->faker->randomElement(['Operator Cetak', 'Desainer', 'Kasir', 'Admin', 'Helper']),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'hire_date' => $this->faker->dateBetween('-2 years', '-1 month'),
            'salary' => $this->faker->randomFloat(2, 2000000, 5000000),
            'status' => 'active',
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}