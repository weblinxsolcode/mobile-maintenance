<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\JobListings;

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
}
