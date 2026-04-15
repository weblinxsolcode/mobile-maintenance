<?php

namespace App\Services;

use App\Models\JobListings;
use App\Models\Notifications;
use App\Models\shop;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

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
            ->with('reviews')
            ->get();
    }

    public static function generateNotification($user_id, $title, $description, $idArray = [])
    {
        $notification = new Notifications;
        $notification->user_id = $user_id;
        $notification->title = $title;
        $notification->description = $description;
        $notification->is_read = false;
        $notification->save();

        // Send push notification
        self::sendPushNotifications($user_id, $title, $description);

        return $notification;
    }

    public static function sendPushNotifications($userID, $title, $description)
    {
        try {
            $firebase = (new Factory)->withServiceAccount(base_path('storage/app/google.json'));
            $messaging = $firebase->createMessaging();

            $message = CloudMessage::fromArray([
                'notification' => [
                    'title' => $title,
                    'body' => $description,
                ],
                'topic' => 'notification_'.$userID,
            ]);

            $messaging->send($message);
        } catch (\Exception $e) {
            Log::error('Firebase Push Notification Error: '.$e->getMessage());
        }
    }
}
