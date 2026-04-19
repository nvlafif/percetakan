<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $kasirRole = Role::firstOrCreate(['name' => 'kasir']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@percetakan.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('12345678'),
            ]
        );
        $admin->assignRole($adminRole);

        $kasir1 = User::firstOrCreate(
            ['email' => 'kasir1@percetakan.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('12345678'),
            ]
        );
        $kasir1->assignRole($kasirRole);

        $kasir2 = User::firstOrCreate(
            ['email' => 'kasir2@percetakan.com'],
            [
                'name' => 'Siti Rahayu',
                'password' => Hash::make('12345678'),
            ]
        );
        $kasir2->assignRole($kasirRole);
    }
}
