<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Apple',
            'Samsung',
            'Xiaomi',
            'Oppo',
            'Vivo',
            'Huawei',
            'OnePlus',
            'Google',
            'Motorola',
            'Sony',
        ];

        foreach ($brands as $index => $brand) {
            DB::table('management')->insert([
                'id' => $index + 1,
                'parent_id' => null,
                'role' => 'brand',
                'name' => $brand,
                'price' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}