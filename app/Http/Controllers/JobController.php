<?php

namespace App\Http\Controllers;

use App\Models\JobListings;
use App\Models\User;
use App\Services\userServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function createJob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'full_name' => 'required',
            'phone_number' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'description' => 'required',
            'service_type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $jobCode = userServices::generateCode();

        $userID = $request->user_id;
        $fullName = $request->full_name;
        $phoneNumber = $request->phone_number;
        $brand = $request->brand;
        $model = $request->model;
        $description = $request->description;
        $serviceType = $request->service_type;

        $checkingUser = User::find($userID);

        if (! $checkingUser) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        $job = new JobListings;
        $job->code = $jobCode;
        $job->user_id = $userID;
        $job->full_name = $fullName;
        $job->phone_number = $phoneNumber;
        $job->brand = $brand;
        $job->model = $model;
        $job->description = $description;
        $job->service_type = $serviceType;
        $job->save();

        $item = JobListings::with('jobApplications', 'userInfo')->find($job->id);

        $list = JobListings::where('user_id', $userID)->with('jobApplications', 'userInfo')->latest()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Job created successfully',
            'item' => $item,
            'count' => $list->count(),
            'list' => $list,
        ], 200);

    }

    public function getJobDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $jobID = $request->job_id;

        $job = JobListings::with('jobApplications', 'userInfo')->find($jobID);

        if (! $job) {
            return response()->json([
                'status' => 'error',
                'message' => 'Job not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Job details fetched successfully',
            'item' => $job,
        ], 200);
    }
}
