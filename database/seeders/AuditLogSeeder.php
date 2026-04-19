<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class AuditLogSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        if ($users->isEmpty()) {
            $users = collect([(object)['id' => 1]]);
        }

        $actions = [
            ['action' => 'create', 'table' => 'products', 'desc' => 'Menambahkan produk baru'],
            ['action' => 'update', 'table' => 'products', 'desc' => 'Mengupdate informasi produk'],
            ['action' => 'create', 'table' => 'transactions', 'desc' => 'Membuat transaksi baru'],
            ['action' => 'create', 'table' => 'employees', 'desc' => 'Menambahkan karyawan baru'],
            ['action' => 'update', 'table' => 'employees', 'desc' => 'Mengupdate data karyawan'],
            ['action' => 'create', 'table' => 'incomes', 'desc' => 'Mencatat pendapatan'],
            ['action' => 'create', 'table' => 'expenses', 'desc' => 'Mencatat pengeluaran'],
            ['action' => 'login', 'table' => 'users', 'desc' => 'User login ke sistem'],
            ['action' => 'logout', 'table' => 'users', 'desc' => 'User logout dari sistem'],
        ];

        for ($i = 0; $i < 50; $i++) {
            $recordId = rand(1, 20);
            
            AuditLog::create([
                'user_id' => $users->random()->id,
                'action' => $actions[array_rand($actions)]['action'],
                'table_name' => $actions[array_rand($actions)]['table'],
                'record_id' => $recordId,
                'old_data' => null,
                'new_data' => ['status' => 'active', 'updated_at' => now()->toArray()],
                'ip_address' => '192.168.1.' . rand(1, 255),
                'created_at' => now()->subDays(rand(0, 60))->subHours(rand(0, 23)),
            ]);
        }
    }
}