<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Payroll;
use App\Models\Salary;
use App\Models\StockIn;
use Illuminate\Database\Seeder;

class FinanceSeeder extends Seeder
{
    public function run(): void
    {
        $transactions = \App\Models\Transaction::where('status', 'completed')->get();
        foreach ($transactions as $transaction) {
            Income::firstOrCreate(
                ['reference' => $transaction->invoice_number],
                [
                    'category' => 'printing',
                    'description' => 'Pendapatan dari transaksi ' . $transaction->invoice_number,
                    'amount' => $transaction->total,
                    'date' => $transaction->created_at,
                    'reference' => $transaction->invoice_number,
                    'status' => 'received',
                    'notes' => 'Pendapatan otomatis dari sistem transaksi',
                ]
            );
        }

        $expenses = [
            ['category' => 'supplies', 'description' => 'Pembelian kertas A4', 'amount' => 3500000, 'date' => now()->subDays(30)],
            ['category' => 'supplies', 'description' => 'Pembelian tinta printer', 'amount' => 2200000, 'date' => now()->subDays(25)],
            ['category' => 'utility', 'description' => 'Pembayaran listrik', 'amount' => 850000, 'date' => now()->subDays(20)],
            ['category' => 'utility', 'description' => 'Pembayaran air', 'amount' => 150000, 'date' => now()->subDays(20)],
            ['category' => 'utility', 'description' => 'Pembayaran internet', 'amount' => 300000, 'date' => now()->subDays(15)],
            ['category' => 'rent', 'description' => 'Sewa toko bulan ini', 'amount' => 2500000, 'date' => now()->subDays(5)],
            ['category' => 'maintenance', 'description' => 'Perawatan mesin cetak', 'amount' => 500000, 'date' => now()->subDays(10)],
            ['category' => 'supplies', 'description' => 'Pembelian perlengkapan kantor', 'amount' => 450000, 'date' => now()->subDays(8)],
            ['category' => 'utility', 'description' => 'Pembayaran listrik', 'amount' => 900000, 'date' => now()->subDays(55)],
            ['category' => 'rent', 'description' => 'Sewa toko bulan lalu', 'amount' => 2500000, 'date' => now()->subDays(35)],
            ['category' => 'maintenance', 'description' => 'Servis mesin offset', 'amount' => 750000, 'date' => now()->subDays(40)],
        ];

        foreach ($expenses as $expense) {
            Expense::create([
                'category' => $expense['category'],
                'description' => $expense['description'],
                'amount' => $expense['amount'],
                'date' => $expense['date'],
                'reference' => 'EXP-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
                'status' => 'paid',
                'notes' => 'Pengeluaran operasional',
            ]);
        }

        $employees = Employee::where('status', 'active')->get();
        $months = ['January', 'February', 'March'];
        
        foreach ($months as $month) {
            $payroll = Payroll::create([
                'period_month' => $month,
                'period_year' => 2025,
                'total_base_salary' => $employees->sum('salary'),
                'total_allowances' => 1500000,
                'total_deductions' => 300000,
                'total_net_salary' => $employees->sum('salary') + 1500000 - 300000,
                'status' => 'paid',
                'payment_date' => now()->subDays(rand(1, 28)),
                'notes' => 'Gaji bulan ' . $month . ' 2025',
            ]);

            foreach ($employees as $employee) {
                $baseSalary = $employee->salary;
                $allowances = rand(200000, 500000);
                $deductions = rand(0, 150000);

                Salary::create([
                    'employee_id' => $employee->id,
                    'base_salary' => $baseSalary,
                    'allowances' => $allowances,
                    'deductions' => $deductions,
                    'net_salary' => $baseSalary + $allowances - $deductions,
                    'payment_date' => $payroll->payment_date,
                    'status' => 'paid',
                    'notes' => 'Gaji bulan ' . $month,
                ]);
            }
        }

        $stockIns = [
            ['product' => 'Kertas A4 Putih 80gsm', 'qty' => 50, 'cost' => 35000],
            ['product' => 'Kertas A4 Warna', 'qty' => 30, 'cost' => 25000],
            ['product' => 'Kertas A3 Putih 80gsm', 'qty' => 20, 'cost' => 65000],
            ['product' => 'Kertas Folio', 'qty' => 100, 'cost' => 15000],
            ['product' => 'Tinta Canon Hitam', 'qty' => 10, 'cost' => 75000],
            ['product' => 'Tinta Canon Warna', 'qty' => 8, 'cost' => 95000],
            ['product' => 'Tinta Epson Hitam', 'qty' => 5, 'cost' => 65000],
            ['product' => 'Spidol Snowman', 'qty' => 20, 'cost' => 8000],
            ['product' => 'Pita Laminasi A4', 'qty' => 10, 'cost' => 45000],
            ['product' => 'Tisu Kamera', 'qty' => 50, 'cost' => 5000],
        ];

        foreach ($stockIns as $stock) {
            $product = \App\Models\Product::where('name', 'like', '%' . $stock['product'] . '%')->first();
            if ($product) {
                StockIn::create([
                    'product_id' => $product->id,
                    'quantity' => $stock['qty'],
                    'unit_cost' => $stock['cost'],
                    'total_cost' => $stock['qty'] * $stock['cost'],
                    'supplier' => 'Toko Alat Tulis Surabaya',
                    'reference_number' => 'PO-' . rand(1000, 9999),
                    'date' => now()->subDays(rand(1, 60)),
                    'notes' => 'Pembelian stok barang',
                ]);
                
                $product->increment('stock', $stock['qty']);
            }
        }
    }
}