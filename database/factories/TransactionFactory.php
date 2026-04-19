<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 10000, 500000);
        $discount = $this->faker->randomFloat(2, 0, $subtotal * 0.1);
        $total = $subtotal - $discount;
        $paidAmount = $total + $this->faker->randomFloat(2, 0, 50000);

        return [
            'invoice_number' => 'INV-' . now()->format('Ymd') . '-' . str_pad($this->faker->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'user_id' => User::whereHas('roles', fn($q) => $q->where('name', 'kasir'))->inRandomOrder()->first()?->id ?? 1,
            'customer_name' => $this->faker->name(),
            'payment_method' => $this->faker->randomElement(['cash', 'transfer', 'qris']),
            'status' => 'completed',
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'paid_amount' => $paidAmount,
            'change_amount' => $paidAmount - $total,
            'notes' => $this->faker->optional()->sentence(),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
    }
}