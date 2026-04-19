<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Kertas A4 Putih 80gsm',
                'sku' => 'KRT-A4-80',
                'category' => 'kertas',
                'description' => 'Kertas HVS A4 ukuran 80gsm, 500 lembar per rim',
                'stock' => 150,
                'min_stock' => 20,
                'unit_cost' => 35000,
                'unit_price' => 45000,
                'status' => 'active',
            ],
            [
                'name' => 'Kertas A4 Warna',
                'sku' => 'KRT-A4-COLOR',
                'category' => 'kertas',
                'description' => 'Kertas warna A4, 100 lembar per paket',
                'stock' => 80,
                'min_stock' => 15,
                'unit_cost' => 25000,
                'unit_price' => 35000,
                'status' => 'active',
            ],
            [
                'name' => 'Kertas A3 Putih 80gsm',
                'sku' => 'KRT-A3-80',
                'category' => 'kertas',
                'description' => 'Kertas HVS A3 ukuran 80gsm, 500 lembar per rim',
                'stock' => 50,
                'min_stock' => 10,
                'unit_cost' => 65000,
                'unit_price' => 85000,
                'status' => 'active',
            ],
            [
                'name' => 'Kertas Folio',
                'sku' => 'KRT-FOLIO',
                'category' => 'kertas',
                'description' => 'Kertas folio ukuran 33x21cm, 100 lembar',
                'stock' => 200,
                'min_stock' => 30,
                'unit_cost' => 15000,
                'unit_price' => 20000,
                'status' => 'active',
            ],
            [
                'name' => 'Tinta Canon Hitam',
                'sku' => 'TNT-CANON-BLK',
                'category' => 'tinta',
                'description' => 'Tinta printer Canon hitam original',
                'stock' => 25,
                'min_stock' => 5,
                'unit_cost' => 75000,
                'unit_price' => 95000,
                'status' => 'active',
            ],
            [
                'name' => 'Tinta Canon Warna',
                'sku' => 'TNT-CANON-COL',
                'category' => 'tinta',
                'description' => 'Tinta printer Canon warna (CMY) original',
                'stock' => 20,
                'min_stock' => 5,
                'unit_cost' => 95000,
                'unit_price' => 125000,
                'status' => 'active',
            ],
            [
                'name' => 'Tinta Epson Hitam',
                'sku' => 'TNT-EPSON-BLK',
                'category' => 'tinta',
                'description' => 'Tinta printer Epson hitam original',
                'stock' => 15,
                'min_stock' => 3,
                'unit_cost' => 65000,
                'unit_price' => 85000,
                'status' => 'active',
            ],
            [
                'name' => 'Spidol Snowman',
                'sku' => 'PLS-SNOWMAN',
                'category' => 'perlengkapan',
                'description' => 'Spidol snowman untuk bahan publish',
                'stock' => 50,
                'min_stock' => 10,
                'unit_cost' => 8000,
                'unit_price' => 12000,
                'status' => 'active',
            ],
            [
                'name' => 'Pita Laminasi A4',
                'sku' => 'LMN-A4',
                'category' => 'perlengkapan',
                'description' => 'Pita laminasi ukuran A4, 100 meter',
                'stock' => 30,
                'min_stock' => 5,
                'unit_cost' => 45000,
                'unit_price' => 65000,
                'status' => 'active',
            ],
            [
                'name' => 'Tisu Kamera',
                'sku' => 'PLS-TISU',
                'category' => 'perlengkapan',
                'description' => 'Tisu kamera untuk pembersihan kepala cetak',
                'stock' => 100,
                'min_stock' => 20,
                'unit_cost' => 5000,
                'unit_price' => 8000,
                'status' => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(['sku' => $product['sku']], $product);
        }
    }
}