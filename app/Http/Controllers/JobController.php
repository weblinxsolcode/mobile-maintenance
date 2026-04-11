<?php

namespace App\Http\Controllers;

use App\Models\JobApplications;
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

        userServices::generateNotification($userID, 'Job Created', 'Your job '.$jobCode.' has been created successfully.');

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

    public function acceptOffer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $applicationID = $request->application_id;

        $application = JobApplications::find($applicationID);

        if (! $application) {
            return response()->json([
                'status' => 'error',
                'message' => 'Application not found',
            ], 404);
        }

        $application->status = 'accepted';
        $application->save();

        userServices::generateNotification($application->user_id, 'Offer Accepted', 'Your offer for job ID '.$application->job_id.' has been accepted.');

        $item = JobListings::with('jobApplications', 'userInfo')->find($application->job_id);

        $list = JobListings::where('user_id', $item->user_id)->with('jobApplications', 'userInfo')->latest()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Application accepted successfully',
            'item' => $item,
            'count' => $list->count(),
            'list' => $list,
        ], 200);
    }

    public function searchingJob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $userID = $request->user_id;
        $code = $request->code;

        $job = JobListings::where('user_id', $userID)->where('code', $code)->with('jobApplications', 'userInfo')->first();

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
