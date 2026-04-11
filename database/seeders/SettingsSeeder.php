<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $new = new Settings;
        $new->google_api_key = 'AIzaSyB86OFACOdLLhVyJ_eJBUWfVIa96NaWnUA';
        $new->near_by_location = '10';
        $new->privacy_policy = 'Lorem Ipsum';
        $new->terms_and_condition = 'Lorem Ipsum';
        $new->about_us = 'Lorem Ipsum';
        $new->save();
    }
}
