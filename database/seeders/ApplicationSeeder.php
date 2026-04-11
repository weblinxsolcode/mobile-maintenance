<?php

namespace Database\Seeders;

use App\Models\JobApplications;
use App\Models\JobListings;
use App\Models\shop;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getJobs = JobListings::all();

        foreach ($getJobs as $job) {

            $getShops = shop::all();

            foreach ($getShops as $key => $item) {
                $new = new JobApplications;
                $new->user_id = $job->user_id;
                $new->job_id = $job->id;
                $new->shop_id = $item->id;
                $new->price = rand(100, 500);
                $new->time = rand(1, 5);
                $new->warranty = rand(0, 1);
                $new->warranty_months = '3 Months';
                $new->save();
            }

        }
    }
}
