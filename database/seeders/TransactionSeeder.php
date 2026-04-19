<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\StockOut;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $kasirUsers = User::role('kasir')->get();
        if ($kasirUsers->isEmpty()) {
            $kasirUsers = User::where('id', '>', 0)->get();
        }

        $servicePrices = [
            'Cetak A4 BW' => 500,
            'Cetak A4 Color' => 1500,
            'Cetak A3 BW' => 1000,
            'Cetak A3 Color' => 2500,
            'Cetak Poster' => 5000,
            'Photocopy A4 BW' => 300,
            'Photocopy A4 Color' => 500,
            'Photocopy A3 BW' => 600,
            'Desain Undangan' => 50000,
            'Desain Brosur' => 75000,
            'Desain Spanduk' => 100000,
            'Desain Kartu Nama' => 25000,
            'Jilid Spiral' => 5000,
            'Jilid Hard Cover' => 15000,
            'Jilid Lem' => 8000,
            'Laminasi A4' => 3000,
            'Laminasi A3' => 5000,
            'Laminasi Poster' => 10000,
        ];

        $transactions = [
            ['customer' => 'PT Maju Jaya', 'items' => [['name' => 'Cetak A4 BW', 'qty' => 100], ['name' => 'Jilid Spiral', 'qty' => 1]], 'payment' => 'transfer'],
            ['customer' => 'Sekolah Islam Terpadu', 'items' => [['name' => 'Cetak A4 Color', 'qty' => 50], ['name' => 'Desain Brosur', 'qty' => 1]], 'payment' => 'transfer'],
            ['customer' => 'Bpk. H. Susanto', 'items' => [['name' => 'Cetak Poster', 'qty' => 20], ['name' => 'Laminasi Poster', 'qty' => 20]], 'payment' => 'cash'],
            ['customer' => 'Toko Buku Sejati', 'items' => [['name' => 'Photocopy A4 BW', 'qty' => 500]], 'payment' => 'transfer'],
            ['customer' => 'Ibu Siti', 'items' => [['name' => 'Desain Undangan', 'qty' => 1], ['name' => 'Cetak A4 Color', 'qty' => 100]], 'payment' => 'cash'],
            ['customer' => 'CV Berkahindo', 'items' => [['name' => 'Cetak A3 BW', 'qty' => 30], ['name' => 'Jilid Hard Cover', 'qty' => 5]], 'payment' => 'transfer'],
            ['customer' => 'Bpk. Ahmad', 'items' => [['name' => 'Desain Kartu Nama', 'qty' => 2], ['name' => 'Cetak A4 BW', 'qty' => 50]], 'payment' => 'cash'],
            ['customer' => 'Universitas Nusantara', 'items' => [['name' => 'Photocopy A4 BW', 'qty' => 1000], ['name' => 'Jilid Lem', 'qty' => 20]], 'payment' => 'transfer'],
            ['customer' => 'Ibu Dewi', 'items' => [['name' => 'Cetak A4 Color', 'qty' => 25], ['name' => 'Laminasi A4', 'qty' => 25]], 'payment' => 'cash'],
            ['customer' => 'PD Karya Abadi', 'items' => [['name' => 'Desain Spanduk', 'qty' => 1], ['name' => 'Cetak Poster', 'qty' => 10]], 'payment' => 'qris'],
            ['customer' => 'Bpk. Budi', 'items' => [['name' => 'Cetak A3 Color', 'qty' => 15]], 'payment' => 'cash'],
            ['customer' => 'Yayasan Pendidikan Al-Azhar', 'items' => [['name' => 'Photocopy A3 BW', 'qty' => 200], ['name' => 'Jilid Spiral', 'qty' => 10]], 'payment' => 'transfer'],
            ['customer' => 'Ibu Lina', 'items' => [['name' => 'Desain Brosur', 'qty' => 1]], 'payment' => 'cash'],
            ['customer' => 'PT Indo Print', 'items' => [['name' => 'Cetak A4 BW', 'qty' => 300], ['name' => 'Cetak A4 Color', 'qty' => 100]], 'payment' => 'transfer'],
            ['customer' => 'Bpk. Dani', 'items' => [['name' => 'Cetak Poster', 'qty' => 5], ['name' => 'Laminasi Poster', 'qty' => 5]], 'payment' => 'cash'],
            ['customer' => 'Ponpes Al-Hidayah', 'items' => [['name' => 'Photocopy A4 BW', 'qty' => 250], ['name' => 'Jilid Lem', 'qty' => 8]], 'payment' => 'qris'],
            ['customer' => 'Ibu Mega', 'items' => [['name' => 'Desain Undangan', 'qty' => 1], ['name' => 'Cetak A4 Color', 'qty' => 150]], 'payment' => 'transfer'],
            ['customer' => 'Toko Elektronik Sejahtera', 'items' => [['name' => 'Cetak A4 BW', 'qty' => 80]], 'payment' => 'cash'],
            ['customer' => 'Bpk. Imam', 'items' => [['name' => 'Cetak A3 BW', 'qty' => 20], ['name' => 'Jilid Hard Cover', 'qty' => 3]], 'payment' => 'transfer'],
            ['customer' => 'Ibu Ratna', 'items' => [['name' => 'Laminasi A4', 'qty' => 50], ['name' => 'Cetak A4 Color', 'qty' => 50]], 'payment' => 'cash'],
        ];

        foreach ($transactions as $index => $transData) {
            $subtotal = 0;
            $discount = 0;

            foreach ($transData['items'] as $item) {
                $price = $servicePrices[$item['name']] ?? 1000;
                $subtotal += $price * $item['qty'];
            }

            if (rand(0, 10) < 3) {
                $discount = $subtotal * (rand(5, 15) / 100);
            }

            $total = $subtotal - $discount;
            $paidAmount = $total + rand(0, 10000);

            $createdDaysAgo = rand(0, 90);
            $createdAt = now()->subDays($createdDaysAgo)->subHours(rand(0, 23))->subMinutes(rand(0, 59));

            $transaction = Transaction::create([
                'invoice_number' => 'INV-' . now()->format('Ymd') . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'user_id' => $kasirUsers->random()->id,
                'customer_name' => $transData['customer'],
                'payment_method' => $transData['payment'],
                'status' => 'completed',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'paid_amount' => $paidAmount,
                'change_amount' => $paidAmount - $total,
                'notes' => rand(0, 10) < 3 ? 'Pelanggan tetap' : null,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            $products = Product::where('status', 'active')->get();

            foreach ($transData['items'] as $item) {
                $price = $servicePrices[$item['name']] ?? 1000;
                $itemSubtotal = $price * $item['qty'];

                $serviceType = match($item['name']) {
                    'Desain Undangan', 'Desain Brosur', 'Desain Spanduk', 'Desain Kartu Nama' => 'design',
                    'Jilid Spiral', 'Jilid Hard Cover', 'Jilid Lem' => 'binding',
                    'Laminasi A4', 'Laminasi A3', 'Laminasi Poster' => 'lamination',
                    default => 'printing',
                };

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'service_name' => $item['name'],
                    'service_type' => $serviceType,
                    'quantity' => $item['qty'],
                    'unit_price' => $price,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            $randomProduct = $products->random();
            $stockOutQty = rand(1, 5);
            if ($randomProduct->stock >= $stockOutQty) {
                StockOut::create([
                    'product_id' => $randomProduct->id,
                    'quantity' => $stockOutQty,
                    'reason' => 'sale',
                    'date' => $createdAt,
                    'notes' => 'Terjual dari transaksi ' . $transaction->invoice_number,
                ]);

                $randomProduct->decrement('stock', $stockOutQty);
            }
        }
    }
}