<?php

namespace App\Http\Controllers;

use App\Models\JobApplications;
use App\Models\Reviews;
use App\Models\Settings;
use App\Models\shop;
use App\Models\Technicians;
use App\Services\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ShopController extends Controller
{
    public function showLogin()
    {
        $title = 'Shop Login';

        if (session()->has('shop_id')) {
            return redirect()->route('shop.dashboard');
        }

        $data = compact('title');

        return view('shop.login', $data);
    }

    public function loginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        try {

            $checkExisting = shop::where('email', $request->email)->first();

            if (!$checkExisting) {
                return redirect()->back()->with('error', 'Please enter valid email.');
            }

            if (!Hash::check($request->password, $checkExisting->password)) {
                return redirect()->back()->with('error', 'Please enter valid password.');
            }

            session()->put('shop_id', $checkExisting->id);

            return redirect()->route('shop.dashboard')->with('success', 'Login successfully');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function logout()
    {
        session()->forget('shop_id');

        return redirect()->route('shop.login')->with('success', 'Logout successfully');
    }

    public function dashboard()
    {
        $title = 'Shop Dashboard';

        $totalTechnicians = Technicians::count();

        $totalJobOffersPending = JobApplications::where('shop_id', session()->get('shop_id'))->where('status', 'pending')->count();

        $totalJobOffersAccepted = JobApplications::where('shop_id', session()->get('shop_id'))->where('status', 'accepted')->count();

        $totalReviews = Reviews::where('shop_id', session()->get('shop_id'))->count();

        $data = compact('title', 'totalTechnicians', 'totalJobOffersPending', 'totalJobOffersAccepted', 'totalReviews');

        return view('shop.dashboard', $data);
    }

    public function appliedJobs()
    {
        $title = 'Job Offer';

        $shopid = session()->get('shop_id');

        $appliedJobs = JobApplications::where('shop_id', $shopid)->where('status', 'pending')->latest()->get();

        $data = compact('title', 'appliedJobs');

        return view('shop.applied-jobs.index', $data);
    }

    public function appliedJobsDetails($id)
    {
        $title = 'Job Offer Details';

        $appliedJobs = JobApplications::where('id', $id)->first();

        $data = compact('title', 'appliedJobs');

        return view('shop.applied-jobs.details', $data);
    }

    public function appliedJobsStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        JobApplications::where('id', $id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function appliedJobsDelete($id)
    {
        JobApplications::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Job deleted successfully');
    }

    public function technicians()
    {
        $title = 'Technicians';

        $techniciansList = Technicians::latest()->get();

        $data = compact('title', 'techniciansList');

        return view('shop.technicians.index', $data);
    }

    public function techniciansCreate()
    {
        $title = 'Add Technician';

        $data = compact('title');

        return view('shop.technicians.create', $data);
    }

    public function techniciansStore(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:technicians,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'phone_number' => 'required',
            'profile_picture' => 'required',
        ]);

        try {

            $filename = null;
            if ($request->hasFile('profile_picture')) {
                $filename = FileHelper::uploadFile($request->file('profile_picture'), 'userImages');
            }

            Technicians::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'profile_picture' => $filename,
                'registration_type' => 'email',
                'status' => 'pending',
            ]);

            return redirect()->route('shop.technicians.index')->with('success', 'Technician added successfully');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function techniciansEdit($id)
    {
        $title = 'Edit Technician';

        $technicians = Technicians::where('id', $id)->first();

        $data = compact('title', 'technicians');

        return view('shop.technicians.edit', $data);
    }

    public function techniciansUpdate(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:technicians,email,' . $id,
            'password' => 'nullable',
            'confirm_password' => 'nullable|same:password',
            'phone_number' => 'required',
            'profile_picture' => 'nullable|image',
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

            $technician->update([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'password' => $password,
                'phone_number' => $request->phone_number,
                'profile_picture' => $filename,
                'registration_type' => 'email',
                'status' => 'pending',
            ]);

            return redirect()
                ->route('shop.technicians.index')
                ->with('success', 'Technician updated successfully');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function techniciansDelete($id)
    {
        Technicians::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Technician deleted successfully');
    }

    public function orders()
    {
        $title = 'Orders';

        $shopid = session()->get('shop_id');


        $appliedJobs = JobApplications::where('shop_id', $shopid)->whereIn('status', ['accepted', 'under_review', 'under_repair', 'ready_for_pickup','delivered'])->latest()->get();


        $data = compact('title', 'appliedJobs');

        return view('shop.orders.index', $data);
    }

    public function ordersDetails($id)
    {
        $title = 'Job Offer Details';

        $appliedJobs = JobApplications::where('id', $id)->first();

        $data = compact('title', 'appliedJobs');

        return view('shop.orders.details', $data);
    }

    public function ordersStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        JobApplications::where('id', $id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function ordersDelete($id)
    {
        JobApplications::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Job deleted successfully');
    }

    public function reviews()
    {
        $title = 'Reviews';

        $shopid = session()->get('shop_id');

        $reviewList = Reviews::where('shop_id', $shopid)->latest()->get();

        $data = compact('title', 'reviewList');

        return view('shop.reviews.index', $data);
    }

    public function reviewsDelete($id)
    {
        Reviews::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Review deleted successfully');
    }

    public function profile()
    {
        $title = 'Profile';

        $shopid = session()->get('shop_id');

        $shopInfo = shop::where('id', $shopid)->first();

        $setting = Settings::find(1);

        $google_api_key = $setting->google_api_key;

        $data = compact('title', 'shopInfo', 'google_api_key');

        return view('shop.profile.index', $data);
    }

    public function profileUpdate(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:shops,email,' . $id,
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'title' => 'required',
            'address' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'description' => 'required',
            'profile' => 'nullable',
        ]);

        try {

            $shop = shop::findOrFail($id);

            // keep old image by default
            $profileImage = $shop->profile;

            // if new image uploaded
            if ($request->hasFile('profile')) {

                if ($shop->profile && file_exists(public_path($shop->profile))) {
                    unlink(public_path($shop->profile));
                }

                $file = $request->file('profile');
                $filename = time() . '.' . $file->getClientOriginalExtension();

                // FIXED PATH
                $file->move(public_path('shops'), $filename);

                $profileImage = 'shops/' . $filename;
            }

            // dd($profileImage);

            $shop->update([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'title' => $request->title,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'description' => $request->description,
                'profile' => $profileImage,
                'status' => 'active',
            ]);

            return redirect()->back()->with('success', 'Profile updated successfully');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function assignedJobs()
    {
        $title = 'Assigned Jobs';

        $shopid = session()->get('shop_id');

        $assignedJobs = JobApplications::where('shop_id', $shopid)
            ->whereIn('status', ['accepted', 'under_review', 'under_repair', 'ready_for_pickup','delivered'])
            ->latest()
            ->get();

        return view('shop.assigned-jobs.index', compact('title', 'assignedJobs'));
    }

    public function assignedJobsCreate($id)
    {
        $title = 'Assigned Jobs To Technicians';

        $jobApplications = JobApplications::where('shop_id', $id)
            ->whereNull('technician_id')
            ->whereIn('status', 'accepted')
            ->latest()
            ->get();

        $techniciansList = Technicians::latest()->get();

        return view('shop.assigned-jobs.create', compact('title', 'jobApplications', 'techniciansList', 'id'));
    }

    public function assignedJobsDetails($id)
    {
        $title = 'Assigned Jobs';

        $jobApplications = JobApplications::where('id', $id)->first();

        return view('shop.assigned-jobs.details', compact('title', 'jobApplications'));
    }

    public function assignedJobsStore(Request $request, $id)
    {
        $request->validate([
            'technician_id' => 'required',
        ]);

        JobApplications::where('id', $id)->update([
            'technician_id' => $request->technician_id,
            'status' => 'under_review',
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('shop.assignedJobs.details', $id)->with('success', 'Job assigned to technician successfully');
    }

    public function reassignForm($id)
    {
        $title = 'Reassign Technician';
        $jobApplication = JobApplications::with('technicianInfo')->findOrFail($id);
        $techniciansList = Technicians::latest()->get();

        return view('shop.assigned-jobs.reassign', compact('title', 'jobApplication', 'techniciansList'));
    }

    public function reassignUpdate(Request $request, $id)
    {
        $request->validate([
            'technician_id' => 'required|exists:technicians,id',
        ]);

        $jobApplication = JobApplications::findOrFail($id);
        $jobApplication->technician_id = $request->technician_id;
        $jobApplication->status = 'under_review';
        $jobApplication->updated_at = Carbon::now();
        $jobApplication->save();

        return redirect()->route('shop.assignedJobs.details', $id)
            ->with('success', 'Technician reassigned successfully.');
    }

    public function removeTechnician($id)
    {
        $jobApplication = JobApplications::findOrFail($id);
        $jobApplication->technician_id = null;
        $jobApplication->status = 'accepted';
        $jobApplication->save();

        return redirect()->route('shop.assignedJobs.details', $id)
            ->with('success', 'Technician removed successfully.');
    }
    public function updateStatus(Request $request, $id)
    {
        $job = JobApplications::findOrFail($id);
        $job->status = $request->status;
        $job->updated_at = Carbon::now();
        $job->save();
        return response()->json(['success' => true]);
    }
}
