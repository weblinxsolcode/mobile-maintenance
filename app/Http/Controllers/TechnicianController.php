<?php

namespace App\Http\Controllers;

use App\Models\JobApplications;
use App\Models\Technicians;
use App\Services\customBlock;
use App\Services\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Factory;

class TechnicianController extends Controller
{
    protected $database;

    protected $firebase;

    public function __construct()
    {
        $this->database = app('firebase.database');
        $this->firebase = (new Factory)->withServiceAccount(base_path('storage/app/google.json'));
    }
    public function showLogin()
    {
        $title = 'Technician Login';

        if (session()->has('technician_id')) {
            return redirect()->route('technician.assignedJobs.index');
        }

        $data = compact('title');

        return view('technician.login', $data);
    }

    public function loginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        try {

            $checkExisting = Technicians::where('email', $request->email)->first();

            if (!$checkExisting) {
                return redirect()->back()->with('error', 'Please enter valid email.');
            }

            if (!Hash::check($request->password, $checkExisting->password)) {
                return redirect()->back()->with('error', 'Please enter valid password.');
            }

            session()->put('technician_id', $checkExisting->id);

            return redirect()->route('technician.assignedJobs.index')->with('success', 'Login successfully');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function logout()
    {
        session()->forget('technician_id');

        return redirect()->route('technician.login')->with('success', 'Logout successfully');
    }

    public function dashboard()
    {
        $title = 'Technician Dashboard';

        $data = compact('title');

        return view('technician.dashboard', $data);
    }
    public function assignedJobs()
    {
        $title = 'My Assigned Jobs';

        $assignJob = JobApplications::with(['jobInfo.shop', 'technicianInfo'])
            ->where('technician_id', session()->get('technician_id'))
            ->latest()
            ->get();

        return view('technician.assigned-jobs.index', compact('title', 'assignJob'));
    }
    public function updateStatus(Request $request, $id)
    {
        $jobApp = JobApplications::where('id', $id)
            ->where('technician_id', session()->get('technician_id'))
            ->firstOrFail();

        $request->validate([
            'repair_status' => 'required',
        ]);

        $jobApp->status = $request->repair_status;
        if ($jobApp->status == 'delivered') {
            $jobApp->updated_at = Carbon::now();
        }

        $statusText = str_replace('_', ' ', $jobApp->status);
        $description = "Your job has been updated to: " . ucwords($statusText) . ". Please check the app for more details.";
        $userID = $jobApp->user_id;

        customBlock::generateNotificaions($userID, 'Job Status Update', $description, $this->database);

        // Log notification in Firebase
        customBlock::pushFireBaseData('notificationLogs', $this->database, [
            'user_id' => $userID,
            'title' => 'Job Status Update',
            'description' => $description,
            'created_at' => Carbon::now(),
        ]);

        $jobApp->save();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'new_status' => $jobApp->repair_status]);
        }

        return back()->with('success', 'Status updated successfully.');
    }
    public function profile()
    {
        $title = 'Profile';

        $technicianId = session()->get('technician_id');

        $technicianInfo = Technicians::where('id', $technicianId)->first();


        $data = compact('title', 'technicianInfo');

        return view('technician.profile.index', $data);
    }

    public function profileUpdate(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:technicians,email,' . $id,
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'phone_number' => 'required',
            'profile_picture' => 'nullable',
        ]);

        try {

            $technician = Technicians::findOrFail($id);

            $filename = $technician->profile_picture;

            if ($request->hasFile('profile_picture')) {

                if ($technician->profile_picture) {
                    FileHelper::deleteFile($technician->profile_picture, 'userImages');
                }

                $filename = FileHelper::uploadFile($request->file('profile_picture'), 'userImages');
            }

            $password = $technician->password;
            if ($request->filled('password')) {
                $password = Hash::make($request->password);
            }

            $technician->full_name = $request->full_name;
            $technician->email = $request->email;
            $technician->password = $password;
            $technician->phone_number = $request->phone_number;
            $technician->profile_picture = $filename;
            $technician->save();

            return redirect()->route('technician.profile')->with('success', 'Profile updated successfully');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}