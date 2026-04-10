<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\UserLog;

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

    public static function generateEmployeeID()
    {
        $length = intval(env('CODE_LENGTH'));

        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= rand(0, 9);
        }

        $empID = 'EMP-'.$code;

        return $empID;
    }

    public static function generateLogs($userID, $type, $log)
    {
        $userActivity = new UserLog;
        $userActivity->user_id = $userID;
        $userActivity->parent = $type;
        $userActivity->value = $log;
        $userActivity->description = $log;
        $userActivity->save();
    }

    public static function generateNotifications($title, $description)
    {
        $notification = new Notification;
        $notification->title = $title;
        $notification->description = $description;
        $notification->save();
    }
}
