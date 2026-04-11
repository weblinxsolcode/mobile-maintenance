<?php

namespace Database\Seeders;

use App\Models\Management;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = ['In Store', 'Home Service', 'Pick Up'];

        foreach ($array as $item) {
            $new = new Management;
            $new->role = 'Service Type';
            $new->name = $item;
            $new->save();
        }
    }
}
