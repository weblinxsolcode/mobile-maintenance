<?php

namespace App\Services;

use App\Models\JobListings;
use App\Models\shop;
use Carbon\Carbon;

class userServices
{
    public static function createOTP()
    {
        $length = intval(env('CODE_LENGTH'));

        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= rand(0, 9);
        }

        return $code;
    }

    public static function generateCode()
    {
        $dateNow = Carbon::now()->format('Ymd');

        $totalJobs = JobListings::all();

        $count = $totalJobs->count();

        return $code = '#'.$dateNow.'-'.$count;
    }

    public static function getNearbyShops($latitude, $longitude, $radius)
    {
        return shop::selectRaw('*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [$latitude, $longitude, $latitude])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->having('distance', '<=', $radius)
            ->orderBy('distance')
            ->where('status', 'active')
            ->get();
    }
}
