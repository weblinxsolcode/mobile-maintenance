<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartSeeder extends Seeder
{
    public function run(): void
    {
        $brands = DB::table('management')->where('role', 'brand')->get();

        foreach ($brands as $brand) {

            DB::table('management')->insert([
                [
                    'parent_id' => $brand->id,
                    'role' => 'part',
                    'name' => 'Screen',
                    'price' => rand(50, 150),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'parent_id' => $brand->id,
                    'role' => 'part',
                    'name' => 'Battery',
                    'price' => rand(30, 120),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}