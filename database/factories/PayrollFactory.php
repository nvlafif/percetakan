<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayrollFactory extends Factory
{
    protected $model = \App\Models\Payroll::class;

    public function definition(): array
    {
        $employees = Employee::where('status', 'active')->get();
        $totalBase = $employees->sum('salary');
        $totalAllowances = $this->faker->randomFloat(2, 500000, 2000000);
        $totalDeductions = $this->faker->randomFloat(2, 100000, 500000);

        return [
            'period_month' => $this->faker->randomElement(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']),
            'period_year' => $this->faker->numberBetween(2024, 2025),
            'total_base_salary' => $totalBase > 0 ? $totalBase : $this->faker->randomFloat(2, 5000000, 15000000),
            'total_allowances' => $totalAllowances,
            'total_deductions' => $totalDeductions,
            'total_net_salary' => ($totalBase > 0 ? $totalBase : $this->faker->randomFloat(2, 5000000, 15000000)) + $totalAllowances - $totalDeductions,
            'status' => 'paid',
            'payment_date' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}