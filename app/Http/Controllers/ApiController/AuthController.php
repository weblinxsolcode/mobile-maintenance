<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Mail\OTPCODE;
use App\Models\User;
use App\Services\StringHelper;
use App\Services\userServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // API For register User by email
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'registration_type' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable',
            'full_name' => 'nullable',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $otp_code = StringHelper::generateOTP();
        $code = $otp_code;
        $name = $request->full_name ?: $request->email;

        $newUser = new User;
        $newUser->registration_type = $request->input('registration_type', 'email');
        $newUser->email = $request->email;
        $newUser->full_name = $request->input('full_name', 'null');
        $newUser->phone_number = $request->input('phone_number');
        $newUser->password = Hash::make($request->password);
        $newUser->otp_code = $code;
        $newUser->status = 'pending';
        $newUser->save();

        // Send OTP Email
        Mail::to($request->email)->send(new OTPCODE($code, $name));

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $newUser,
        ], 200);
    }

    // API For Verifying OTP
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp_code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        if ($user->otp_code !== $request->otp_code) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid OTP code',
            ], 401);
        }

        $user->status = 'active';
        $user->save();

        userServices::generateNotification($user->id, 'Welcome!', 'Welcome to Mobile Maintenance. Your account is now active.');

        // $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'OTP verified successfully. Account activated.',
            'data' => $user,
        ], 200);
    }

    // API For User Login
    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => $user ? 'Invalid password' : 'Invalid email',
            ], $user ? 401 : 404);
        }

        // otp verification check
        $name = $user->full_name ?: $user->email;
        $code = StringHelper::generateOTP();
        $user->otp_code = $code;
        $user->save();

        if ($user->status !== 'active') {

            Mail::to($request->email)->send(new OTPCODE($code, $name));

            return response()->json([
                'status' => 'success',
                'message' => 'Signup successful. Account inactive. OTP sent to your email.',
                'data' => $user,
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => $user,

        ], 200);
    }

    // API For Forget Password
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation email failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email not found',
            ], 404);
        }

        $otp_code = StringHelper::generateOTP();
        $user->otp_code = $otp_code;
        $user->save();
        $name = $user->full_name ?: $user->email;

        Mail::to($request->email)->send(new OTPCODE($otp_code, $name));

        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent to your email for password reset',
            // 'data' => $user,
        ], 200);
    }

    // API For Reset Password
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 401);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password reset successful',
            'data' => $user,
        ], 200);
    }

    // API For Update password
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::find($request->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Old password is incorrect',
            ], 401);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully',
        ], 200);
    }

    // API For Account Delete
    public function accountDelete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Account deleted successfully',
        ], 200);
    }
}
