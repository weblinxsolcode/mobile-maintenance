<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shops')->insert([
            [
                'profile' => 'shops/shop1.jpg',
                'title' => 'Saddar Mobile Repair Center',
                'description' => 'Screen replacement, battery issues, and software repair.',
                'address' => 'Saddar, Karachi',
                'latitude' => '24.8607',
                'longitude' => '67.0011',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'profile' => 'shops/shop2.jpg',
                'title' => 'Clifton Phone Fixers',
                'description' => 'Expert in iPhone and Android repair services.',
                'address' => 'Clifton, Karachi',
                'latitude' => '24.8138',
                'longitude' => '67.0305',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'profile' => 'shops/shop3.jpg',
                'title' => 'Gulshan Mobile Lab',
                'description' => 'Hardware repair, flashing, and unlocking services.',
                'address' => 'Gulshan-e-Iqbal, Karachi',
                'latitude' => '24.9056',
                'longitude' => '67.0822',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'profile' => 'shops/shop4.jpg',
                'title' => 'Nazimabad Repair Hub',
                'description' => 'Affordable phone repair with quick turnaround time.',
                'address' => 'Nazimabad, Karachi',
                'latitude' => '24.9260',
                'longitude' => '67.0330',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'profile' => 'shops/shop5.jpg',
                'title' => 'DHA Tech Repair',
                'description' => 'Premium repair service for all smartphone brands.',
                'address' => 'DHA, Karachi',
                'latitude' => '24.8000',
                'longitude' => '67.0500',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'profile' => 'shops/shop6.jpg',
                'title' => 'Korangi Mobile Solutions',
                'description' => 'Charging port, speaker, and mic repair specialists.',
                'address' => 'Korangi, Karachi',
                'latitude' => '24.8300',
                'longitude' => '67.1200',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'profile' => 'shops/shop7.jpg',
                'title' => 'Malir Phone Repair Shop',
                'description' => 'All kinds of smartphone repair at affordable prices.',
                'address' => 'Malir, Karachi',
                'latitude' => '24.8900',
                'longitude' => '67.1900',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'profile' => 'shops/shop8.jpg',
                'title' => 'North Karachi Mobile Lab',
                'description' => 'Fast and reliable mobile repair services.',
                'address' => 'North Karachi, Karachi',
                'latitude' => '24.9500',
                'longitude' => '67.0700',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}