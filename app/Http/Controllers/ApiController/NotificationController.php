<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $notifications = Notifications::where('user_id', $request->user_id)->latest()->get();

        return response()->json([
            'status' => 'success',
            'count' => $notifications->count(),
            'data' => $notifications,
        ], 200);
    }

    public function markAsRead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        Notifications::where('user_id', $request->user_id)->update([
            'is_read' => true,
        ]);

        $list = Notifications::where('user_id', $request->user_id)->latest()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Notification marked as read',
            'data' => $list,
        ], 200);
    }
}
