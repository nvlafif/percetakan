<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalaryFactory extends Factory
{
    protected $model = \App\Models\Salary::class;

    public function definition(): array
    {
        $baseSalary = $this->faker->randomFloat(2, 2000000, 5000000);
        $allowances = $this->faker->randomFloat(2, 100000, 500000);
        $deductions = $this->faker->randomFloat(2, 0, 200000);

        return [
            'employee_id' => Employee::inRandomOrder()->first()?->id ?? 1,
            'base_salary' => $baseSalary,
            'allowances' => $allowances,
            'deductions' => $deductions,
            'net_salary' => $baseSalary + $allowances - $deductions,
            'payment_date' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'status' => 'paid',
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}