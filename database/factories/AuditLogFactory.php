<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuditLogFactory extends Factory
{
    protected $model = \App\Models\AuditLog::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id,
            'action' => $this->faker->randomElement(['create', 'update', 'delete', 'login', 'logout']),
            'table_name' => $this->faker->randomElement(['users', 'products', 'transactions', 'employees', 'incomes', 'expenses']),
            'record_id' => $this->faker->numberBetween(1, 100),
            'old_data' => $this->faker->optional()->randomElements(['name' => $this->faker->name(), 'status' => 'active'], 2),
            'new_data' => $this->faker->optional()->randomElements(['name' => $this->faker->name(), 'status' => 'inactive'], 2),
            'ip_address' => $this->faker->ipv4(),
        ];
    }
}