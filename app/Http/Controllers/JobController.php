<?php

namespace App\Http\Controllers;

use App\Models\JobApplications;
use App\Models\JobListings;
use App\Models\Reviews;
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

        userServices::sendPushNotifications($userID, 'Job Created', 'Your job '.$jobCode.' has been created successfully.');

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

        userServices::sendPushNotifications($application->user_id, 'Offer Accepted', 'Your offer for job ID '.$application->job_id.' has been accepted.');

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

    public function storeReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'job_id' => 'required',
            'rating' => 'required',
            'review' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $userID = $request->user_id;
        $jobID = $request->job_id;
        $rating = $request->rating;
        $review = $request->review;

        $job = JobListings::find($jobID);

        if (! $job) {
            return response()->json([
                'status' => 'error',
                'message' => 'Job not found',
            ], 404);
        }

        $getAcceptedOffer = JobApplications::where('job_id', $jobID)->where('status', 'accepted')->first();

        if (! $getAcceptedOffer) {
            return response()->json([
                'status' => 'error',
                'message' => 'No accepted offer found for this job',
            ], 404);
        }

        $checkExisting = Reviews::where('job_id', $jobID)->where('user_id', $userID)->first();

        if ($checkExisting) {
            return response()->json([
                'status' => 'error',
                'message' => 'Review already exists for this job',
            ], 400);
        }

        $shopID = $getAcceptedOffer->shop_id;

        $new = new Reviews;
        $new->user_id = $userID;
        $new->shop_id = $shopID;
        $new->job_id = $jobID;
        $new->rating = $rating;
        $new->review = $review;
        $new->save();

        userServices::generateNotification($userID, 'Review Stored', 'Your review for job ID '.$jobID.' has been stored successfully.');

        userServices::sendPushNotifications($userID, 'Review Stored', 'Your review for job ID '.$jobID.' has been stored successfully.');

        $item = JobListings::with('jobApplications', 'userInfo')->find($jobID);

        $list = JobListings::where('user_id', $userID)->with('jobApplications', 'userInfo')->latest()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Review stored successfully',
            'item' => $item,
            'count' => $list->count(),
            'list' => $list,
        ], 200);
    }

    public function getReviews(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $key = $request->key;
        $value = $request->value;

        $reviews = Reviews::where($key, $value)->latest()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Reviews fetched successfully',
            'count' => $reviews->count(),
            'list' => $reviews,
        ], 200);
    }

    public function getUserJobs(Request $request)
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

        $userID = $request->user_id;

        $list = JobListings::where('user_id', $userID)->with('jobApplications', 'userInfo')->latest()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Jobs fetched successfully',
            'count' => $list->count(),
            'list' => $list,
        ], 200);

    }
}
