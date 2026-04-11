<?php

namespace App\Services;

use App\Models\JobListings;
use App\Models\Notifications;
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
            ->where('status', 'active')
            ->orderBy('distance')
            ->get();
    }

    public static function generateNotification($user_id, $title, $description)
    {
        $notification = new Notifications;
        $notification->user_id = $user_id;
        $notification->title = $title;
        $notification->description = $description;
        $notification->is_read = false;
        $notification->save();

        return $notification;
    }
}
