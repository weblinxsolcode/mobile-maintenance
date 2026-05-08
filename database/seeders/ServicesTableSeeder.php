<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceMeta;

class ServicesTableSeeder  extends Seeder
{
    public function run(): void
    {
        // Create Services
        $screenService = Service::create([
            'title' => 'Mobile Screen Repair',
            'description' => 'Fix cracked or broken mobile screens for all major brands.',
            'cover_image' => 'screen_repair.png',
            'status' => 'active',
        ]);

        $batteryService = Service::create([
            'title' => 'Battery Replacement',
            'description' => 'Replace weak or damaged mobile batteries with new ones.',
            'cover_image' => 'battery_repair.png',
            'status' => 'active',
        ]);

        // Service Metas (Skills / Extra Info)
        $metas = [
            // Screen Service Skills
            [
                'services_id' => $screenService->id,
                'type' => 'skill',
                'value' => 'Glass Replacement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'services_id' => $screenService->id,
                'type' => 'skill',
                'value' => 'LCD Repair',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Battery Service Skills
            [
                'services_id' => $batteryService->id,
                'type' => 'skill',
                'value' => 'Battery Diagnosis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'services_id' => $batteryService->id,
                'type' => 'skill',
                'value' => 'Battery Replacement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        ServiceMeta::insert($metas);
    }
}