<?php

namespace App\Http\Controllers;

use App\Models\Management;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManagementController extends Controller
{
    public function getManagement(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $list = Management::where('role', $request->type)->with('child')->get();

        $count = $list->count();

        $requestedQuery = $request->type;

        return response()->json([
            'status' => 'success',
            'message' => $requestedQuery,
            'count' => $count,
            'list' => $list,
        ], 200);
    }

    public function getSettings()
    {
        $item = Settings::latest()->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Settings fetched successfully',
            'item' => $item,
        ], 200);
    }
}
