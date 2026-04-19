<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                'name' => 'Ahmad Fauzi',
                'position' => 'Operator Cetak',
                'phone' => '081234567890',
                'email' => 'ahmad@percetakan.com',
                'hire_date' => '2023-01-15',
                'salary' => 3500000,
                'status' => 'active',
                'notes' => 'Bertanggung jawab atas mesin cetak digital',
            ],
            [
                'name' => 'Diana Putri',
                'position' => 'Desainer',
                'phone' => '081234567891',
                'email' => 'diana@percetakan.com',
                'hire_date' => '2023-03-20',
                'salary' => 4000000,
                'status' => 'active',
                'notes' => 'Ahli desain grafis dan branding',
            ],
            [
                'name' => 'Rendi Kurniawan',
                'position' => 'Operator Cetak',
                'phone' => '081234567892',
                'email' => 'rendi@percetakan.com',
                'hire_date' => '2023-06-01',
                'salary' => 3200000,
                'status' => 'active',
                'notes' => 'Operator mesin offset',
            ],
            [
                'name' => 'Maya Sari',
                'position' => 'Admin',
                'phone' => '081234567893',
                'email' => 'maya@percetakan.com',
                'hire_date' => '2022-11-10',
                'salary' => 3500000,
                'status' => 'active',
                'notes' => 'Menghandle administrasi dan keuangan',
            ],
            [
                'name' => 'Fajar Nugroho',
                'position' => 'Helper',
                'phone' => '081234567894',
                'email' => 'fajar@percetakan.com',
                'hire_date' => '2024-01-05',
                'salary' => 2500000,
                'status' => 'active',
                'notes' => 'Membantu operasional percetakan',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::firstOrCreate(['email' => $employee['email']], $employee);
        }
    }
}