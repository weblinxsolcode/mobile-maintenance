<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\shop;
use App\Models\User;
use App\Services\FileHelper;
use App\Services\userServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    // Api For Shop Create
    public function createShop(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => 'required',
            'profile' => 'nullable',
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $usersID = $request->users_id;
        $title = $request->title;
        $description = $request->description;
        $address = $request->address;
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $file = $request->file('profile');

        if ($file) {
            $imagePath = FileHelper::uploadImage($file, 'shopImage');
        }

        $user = User::where('id', $usersID);
        if (! $user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 401);
        }

        $shop = new shop;
        $shop->users_id = $usersID;
        $shop->profile = $imagePath ?? 'default.jpg';
        $shop->title = $title;
        $shop->description = $description;
        $shop->address = $address;
        $shop->latitude = $latitude;
        $shop->longitude = $longitude;
        $shop->status = 'pending';
        $shop->save();

        userServices::generateNotification($usersID, 'Shop Created', 'Your shop '.$title.' has been created successfully and is now pending for approval.');

        return response()->json([
            'status' => 'success',
            'message' => 'Shop created successfully',
            'data' => $shop,
        ], 200);
    }

    // Api For Get All Shop
    public function getAllShop()
    {
        $shops = shop::all();

        if ($shops->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No shops found',
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'data' => $shops,
        ], 200);
    }

    // Api For Get Shop by id
    public function getShop(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shop_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        $shops = shop::where('id', $request->shop_id)->first();

        if (! $shops) {
            return response()->json([
                'status' => 'error',
                'message' => 'No shops found',
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'data' => $shops,
        ], 200);
    }

    public function getNearByShops(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $settings = Settings::latest()->first();
        $circleRadius = $settings ? (float) $settings->near_by_location : 10;

        $latitude = $request->latitude;
        $longitude = $request->longitude;

        // Haversine formula to calculate distance in kilometers
        $shops = userServices::getNearbyShops($latitude, $longitude, $circleRadius);

        $count = $shops->count();

        if ($shops->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No shops found within '.$circleRadius.'km',
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'count' => $count,
            'list' => $shops,
        ], 200);
    }
}
