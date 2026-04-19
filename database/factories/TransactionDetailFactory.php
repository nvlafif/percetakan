<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionDetailFactory extends Factory
{
    protected $model = \App\Models\TransactionDetail::class;

    public function definition(): array
    {
        $serviceTypes = ['printing', 'photocopy', 'design', 'binding', 'lamination'];
        $serviceType = $this->faker->randomElement($serviceTypes);
        
        $serviceNames = [
            'printing' => ['Cetak A4 BW', 'Cetak A4 Color', 'Cetak A3 BW', 'Cetak A3 Color', 'Cetak Poster'],
            'photocopy' => ['Photocopy A4 BW', 'Photocopy A4 Color', 'Photocopy A3 BW'],
            'design' => ['Desain Undangan', 'Desain Brosur', 'Desain Spanduk', 'Desain Kartu Nama'],
            'binding' => ['Jilid Spiral', 'Jilid Hard Cover', 'Jilid Lem'],
            'lamination' => ['Laminasi A4', 'Laminasi A3', 'Laminasi Poster'],
        ];

        $serviceName = $this->faker->randomElement($serviceNames[$serviceType] ?? ['Layanan Umum']);
        $quantity = $this->faker->numberBetween(1, 100);
        $unitPrice = $this->faker->randomFloat(2, 500, 50000);
        $subtotal = $quantity * $unitPrice;

        return [
            'transaction_id' => Transaction::inRandomOrder()->first()?->id ?? 1,
            'service_name' => $serviceName,
            'service_type' => $serviceType,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'subtotal' => $subtotal,
        ];
    }
}