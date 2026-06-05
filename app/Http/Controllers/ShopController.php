<?php

namespace App\Http\Controllers;

use App\Models\JobApplications;
use App\Models\JobListings;
use App\Models\Management;
use App\Models\Notifications;
use App\Models\price_histories;
use App\Models\Reviews;
use App\Models\Service;
use App\Models\ServiceMeta;
use App\Models\Settings;
use App\Models\shop;
use App\Models\shopService;
use App\Models\Technicians;
use App\Services\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Services\customBlock;
use Kreait\Firebase\Factory;

class ShopController extends Controller
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

        $totalJob = JobListings::count();

        $totalOrder = JobApplications::where('shop_id', session()->get('shop_id'))->whereIn('status', ["accepted", "under_review", "under_repair", "ready_for_pickup", "delivered"])->count();


        $totalReviews = Reviews::where('shop_id', session()->get('shop_id'))->count();

        $data = compact('title', 'totalTechnicians', 'totalJob', 'totalOrder', 'totalReviews');

        return view('shop.dashboard', $data);
    }

    public function appliedJobs()
    {
        $title = 'Job Listings';

        $appliedJobs = JobListings::latest()->get();

        $appliedJobs = JobListings::with('service')->latest()->get();

        $data = compact('title', 'appliedJobs');

        return view('shop.applied-jobs.index', $data);
    }

    public function appliedJobsDetails($id)
    {
        $title = 'Job Listings Details';

        $shopid = session()->get('shop_id');

        $appliedJobs = JobListings::where('id', $id)->first();

        $data = compact('title', 'appliedJobs', 'shopid');

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
        JobListings::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Job deleted successfully');
    }
    public function submitOffer(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            "price" => "required",
            "time" => "required",
            'warranty' => 'required|in:0,1',
            'warranty_months' => 'required_if:warranty,1',
            "description" => "required",
            'image' => 'nullable|image',
        ]);


        try {
            // JobApplications::create([
            //     "user_id" => $request->user_id,
            //     "shop_id" => session()->get('shop_id'),
            //     "job_id" => $id,
            //     "technician_id" => null,
            //     "status" => "pending",
            //     "price" => $request->price,
            //     "time" => $request->time,
            //     "warranty" => $request->warranty,
            //     "warranty_months" => $request->warranty_months,
            //     "description" => $request->description,
            // ]);

            $new = new JobApplications();
            $new->user_id = $request->user_id;
            $new->shop_id = session()->get('shop_id');
            $new->job_id = $id;
            $new->technician_id = null;
            $new->status = "pending";
            $new->title = $request->title;
            $new->price = $request->price;
            $new->time = $request->time;
            $new->warranty = $request->warranty;
            $new->warranty_months = $request->warranty_months;
            $new->description = $request->description;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('jobs'), $filename);
                $new->image = 'jobs/' . $filename;
            }


            $title = 'New Job Offer';
            $description = 'You have a new job offer. Please check your Mobile App.';
            $userID = $request->user_id;

            customBlock::generateNotificaions($userID, $title, $description, $this->database);

            // Log notification in Firebase
            customBlock::pushFireBaseData('notificationLogs', $this->database, [
                'user_id' => $request->user_id,
                'title' => $title,
                'description' => $description,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);


            $new->save();

            return redirect()->back()->with('success', 'Offer submitted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => 'Something went wrong. Please try again later.'
            ]);
        }
    }

    public function submitOfferUpdate(Request $request, $offerId)
    {
        $request->validate([
            'title' => 'required|string',
            "price" => "required",
            "time" => "required",
            'warranty' => 'required|in:0,1',
            'warranty_months' => 'required_if:warranty,1',
            "description" => "required",
            'image' => 'nullable|image',
        ]);

        $offer = JobApplications::findOrFail($offerId);
        // Authorize that this shop owns the offer
        if ($offer->shop_id != session()->get('shop_id')) {
            abort(403);
        }

        $oldPrice = $offer->price;
        $newPrice = $request->price;

        $offer->title = $request->title;
        $offer->price = $newPrice;
        $offer->time = $request->time;
        $offer->warranty = $request->warranty;
        $offer->warranty_months = $request->warranty_months;
        $offer->description = $request->description;

        if ($request->hasFile('image')) {
            if ($offer->image && file_exists(public_path($offer->image))) {
                unlink(public_path($offer->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('jobs'), $filename);
            $offer->image = 'jobs/' . $filename;
        }

        $offer->save();

        // If price has changed, store history
        if ($oldPrice != $newPrice) {
            price_histories::create([
                'job_application_id' => $offer->id,
                'old_price' => $oldPrice,
                'new_price' => $newPrice,
                'changed_by' => session()->get('shop_id'), // assuming shop relation exists
            ]);
        }

        $title = 'Job Offer Updated';
        if ($oldPrice != $newPrice) {
            $description = "Your job offer price has been updated from $oldPrice to $newPrice. Please check your Mobile App.";
        } else {
            $description = "Your job offer has been updated. Please check your Mobile App.";
        }
        $userID = $offer->user_id;

        customBlock::generateNotificaions($userID, $title, $description, $this->database);

        // Log notification in Firebase
        customBlock::pushFireBaseData('notificationLogs', $this->database, [
            'user_id' => $offer->user_id,
            'title' => $title,
            'description' => $description,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


        return redirect()->back()->with('success', 'Offer updated successfully.');
    }


    public function acceptOffer(Request $request, $id)
    {
        $shopId = session()->get('shop_id');
        $existing = JobApplications::where('job_id', $id)
            ->where('shop_id', $shopId)
            ->where('status', 'accepted')
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'You have already accepted this offer.');
        }

        $job = JobListings::findOrFail($id);

        $service = Service::with('serviceMetas')->find($job->service_id);

        $servicePrice = $service?->serviceMetas
            ->firstWhere('type', 'price')
                ?->value ?? 0;

        // try {

        $new = new JobApplications();
        $new->user_id = $job->user_id ?? null;
        $new->shop_id = session()->get('shop_id');
        $new->job_id = $id;
        $new->technician_id = null;
        $new->service_id = $service?->id;
        $new->price = $servicePrice;
        $new->status = 'accepted';
        $new->time = $request->time ?? null;
        $new->warranty = $request->warranty ?? null;
        $new->warranty_months = $request->warranty_months ?? null;
        $new->description = $request->description ?? null;
        $new->save();

        return redirect()->back()->with('success', 'Offer submitted successfully');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with([
        //         'error' => 'Something went wrong. Please try again later.'
        //     ]);
        // }
    }

    // Services
    public function services()
    {
        $title = 'Services';

        $shopid = session()->get('shop_id');
        $ServiceIds = ShopService::where('shop_id', $shopid)->pluck('services_id');

        $servicesList = Service::whereIn('id', $ServiceIds)->latest()->get();
        $servicesList->load(['serviceMetas']);

        $data = compact('title', 'servicesList');

        return view('shop.services.index', $data);
    }

    public function servicesCreate()
    {
        $title = 'Add Service';

        $data = compact('title');

        return view('shop.services.create', $data);
    }


    public function servicesStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'cover_image' => 'required|image',
            'status' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'skills' => 'required|string',
        ]);



        // Upload image
        $filename = null;

        if ($request->hasFile('cover_image')) {
            $filename = FileHelper::uploadFile($request->file('cover_image'), 'jobs');
        }

        // Create main service
        $service = Service::create([
            'title' => $request->title,
            'description' => $request->description,
            'cover_image' => $filename,
            'status' => $request->status,
        ]);


        $metaData = [
            'brand' => $request->brand,
            'model' => $request->model,
            'price' => $request->price,
            'discount' => $request->discount,
        ];

        foreach ($metaData as $type => $value) {
            ServiceMeta::create([
                'services_id' => $service->id,
                'type' => $type,
                'value' => $value,
            ]);
        }

        $skills = array_filter(array_map('trim', explode(',', $request->skills)));

        foreach ($skills as $skill) {
            ServiceMeta::create([
                'services_id' => $service->id,
                'type' => 'skill',
                'value' => $skill,
            ]);
        }

        ShopService::create([
            'services_id' => $service->id,
            'shop_id' => session()->get('shop_id'),
        ]);

        return redirect()
            ->route('shop.services.index')
            ->with('success', 'Service added successfully');
    }

    public function servicesDelete($id)
    {
        Service::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Service deleted successfully');
    }

    public function servicesEdit($id)
    {
        $title = 'Edit Service';

        $service = Service::where('id', $id)->first();

        $metas = ServiceMeta::where('services_id', $service->id)->get();

        return view('shop.services.edit', compact('title', 'service', 'metas'));
    }


    public function servicesUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'skills' => 'required|string',
            'cover_image' => 'nullable|image',
        ]);

        $service = Service::findOrFail($id);

        /*
    |---------------------------------
    | UPDATE MAIN SERVICE
    |---------------------------------
    */
        $filename = $service->cover_image;

        if ($request->hasFile('cover_image')) {
            $filename = FileHelper::uploadFile($request->file('cover_image'), 'jobs');
        }

        $service->update([
            'title' => $request->title,
            'description' => $request->description,
            'cover_image' => $filename,
        ]);

        /*
    |---------------------------------
    | DELETE OLD METAS (IMPORTANT)
    |---------------------------------
    */
        ServiceMeta::where('services_id', $service->id)->delete();

        /*
    |---------------------------------
    | RECREATE SINGLE VALUE METAS
    |---------------------------------
    */
        $metaData = [
            'brand' => $request->brand,
            'model' => $request->model,
            'price' => $request->price,
            'discount' => $request->discount,
        ];

        foreach ($metaData as $type => $value) {
            ServiceMeta::create([
                'services_id' => $service->id,
                'type' => $type,
                'value' => $value,
            ]);
        }

        /*
    |---------------------------------
    | RECREATE SKILLS (MULTIPLE)
    |---------------------------------
    */
        $skills = array_filter(array_map('trim', explode(',', $request->skills)));

        foreach ($skills as $skill) {
            ServiceMeta::create([
                'services_id' => $service->id,
                'type' => 'skill',
                'value' => $skill,
            ]);
        }

        return redirect()
            ->route('shop.services.index')
            ->with('success', 'Service updated successfully');
    }

    public function servicesStatusUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        Service::where('id', $id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status updated successfully');
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


        $appliedJobs = JobApplications::where('shop_id', $shopid)->whereIn('status', ['accepted', 'under_review', 'under_repair', 'ready_for_pickup', 'delivered'])->latest()->get();


        $data = compact('title', 'appliedJobs');

        return view('shop.orders.index', $data);
    }

    public function ordersDetails($id)
    {
        $title = 'Job Offer Details';

        $appliedJobs = JobApplications::with('priceHistories.changedByShop')
            ->where('id', $id)
            ->where('shop_id', session()->get('shop_id')) // only if the job has a shop_id column
            ->firstOrFail();

        return view('shop.orders.details', compact('title', 'appliedJobs'));
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
            'phone_number' => 'nullable|string',
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
                'phone_number' => $request->phone_number,
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
        $title = 'Assigned Technicians';

        $shopid = session()->get('shop_id');

        $assignedJobs = JobApplications::where('shop_id', $shopid)->where('service_id', '=', null)
            ->whereIn('status', ['accepted', 'under_review', 'under_repair', 'ready_for_pickup', 'delivered'])
            ->latest()
            ->get();
        $assignedJobs->load(['jobInfo.service']);

        $assignedServiceJobs = JobApplications::where('shop_id', $shopid)->where('service_id', '!=', null)
            ->whereIn('status', ['accepted', 'under_review', 'under_repair', 'ready_for_pickup', 'delivered'])
            ->latest()
            ->get();
        $assignedServiceJobs->load(['jobInfo.service']);

        return view('shop.assigned-jobs.index', compact('title', 'assignedJobs', 'assignedServiceJobs'));
    }

    public function assignedJobsCreate($id)
    {
        $title = 'Assigned Jobs To Technicians';

        $jobApplications = JobApplications::where('id', $id)
            ->whereNull('technician_id')
            ->whereIn('status', ['accepted', 'under_review', 'under_repair', 'ready_for_pickup', 'delivered'])
            ->first();


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

        $title = 'Job Status';
        $description = 'Your job status has been updated to: Under Review. Please check the app for more details.';
        $userID = $request->user_id;

        customBlock::generateNotificaions($userID, $title, $description, $this->database);

        // Log notification in Firebase
        customBlock::pushFireBaseData('notificationLogs', $this->database, [
            'user_id' => $userID,
            'title' => $title,
            'description' => $description,
            'created_at' => Carbon::now(),
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
        if ($job->status == 'delivered') {
            $job->updated_at = Carbon::now();
        }

        $title = 'Job Status Update';

        $statusText = str_replace('_', ' ', $job->status);
        $description = "Your job has been updated to: " . ucwords($statusText) . ". Please check the app for more details.";
        $userID = $job->user_id;

        customBlock::generateNotificaions($userID, $title, $description, $this->database);

        // Log notification in Firebase
        customBlock::pushFireBaseData('notificationLogs', $this->database, [
            'user_id' => $userID,
            'title' => $title,
            'description' => $description,
            'created_at' => Carbon::now(),
        ]);


        $job->save();
        return response()->json(['success' => true]);
    }
    public function brands()
    {
        $title = 'Brands';

        $brand = Management::where('role', 'Brand')->latest()->get();


        $data = compact('title', 'brand');

        return view('shop.brands.index', $data);
    }
    public function brandsDelete($id)
    {
        Management::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Brand deleted successfully');
    }
    public function storeBrand(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Management::create([
            'name' => $request->name,
            'role' => 'Brand'
        ]);

        return redirect()->back()->with('success', 'Brand created successfully');
    }
    public function updateBrand(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Management::where('id', $id)->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Brand updated successfully');
    }
    public function models()
    {
        $title = 'Models';

        $model = Management::where('role', 'Model')
            ->with('brand')
            ->latest()
            ->get();

        $brands = Management::where('role', 'Brand')->get();

        $data = compact('title', 'model', 'brands');

        return view('shop.models.index', $data);
    }
    public function storeModel(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'required'
        ]);

        Management::create([
            'name' => $request->name,
            'role' => 'Model',
            'parent_id' => $request->parent_id
        ]);

        return redirect()->back()->with('success', 'Model created successfully');
    }
    public function updateModel(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'required'
        ]);

        Management::where('id', $id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id
        ]);

        return redirect()->back()->with('success', 'Model updated successfully');
    }

    public function saveReceipt(Request $request)
    {
        $request->validate([
            'job_application_id' => 'required',
            'receipt_type' => 'required|in:check_in,final',
            'customer_signature' => 'required',
            'receipt_data' => 'required|array',
        ]);

        $shopId = session()->get('shop_id');
        $jobApp = JobApplications::where('id', $request->job_application_id)
            ->where('shop_id', $shopId)
            ->firstOrFail();

        $shop = shop::findOrFail($shopId);

        $receipt = \App\Models\ReceiptRecord::updateOrCreate(
            [
                'job_application_id' => $request->job_application_id,
                'receipt_type' => $request->receipt_type,
            ],
            [
                'shop_name' => $shop->title ?? 'Mobile Maintenance Shop',
                'shop_phone' => $request->shop_phone ?? $shop->email ?? 'N/A',
                'shop_address' => $request->shop_address ?? $shop->address ?? 'Shop Address',
                'receipt_data' => $request->receipt_data,
                'customer_signature' => $request->customer_signature,
                'technician_signature' => $request->technician_signature,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Receipt saved successfully in the system!',
            'receipt' => $receipt
        ]);
    }

    public function getReceipt($job_application_id, $type)
    {
        $shopId = session()->get('shop_id');
        $jobApp = JobApplications::where('id', $job_application_id)
            ->where('shop_id', $shopId)
            ->firstOrFail();

        $receipt = \App\Models\ReceiptRecord::where('job_application_id', $job_application_id)
            ->where('receipt_type', $type)
            ->first();

        if (!$receipt) {
            return response()->json([
                'success' => false,
                'message' => 'No saved receipt found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'receipt' => $receipt
        ]);
    }

    public function backupIndex()
    {
        $title = "Backup & Restore";
        $settings = \App\Models\BackupSetting::firstOrCreate(
            ['shop_id' => session()->get('shop_id')],
            [
                'auto_backup' => true,
                'external_path' => null,
                'retention_days' => 7,
            ]
        );

        $logs = \App\Models\BackupLog::orderBy('created_at', 'desc')->get();

        return view('shop.backup.index', compact('title', 'settings', 'logs'));
    }

    public function updateBackupSettings(Request $request)
    {
        $request->validate([
            'retention_days' => 'required|integer|min:1|max:365',
            'external_path' => 'nullable|string',
        ]);

        $settings = \App\Models\BackupSetting::firstOrCreate(['shop_id' => session()->get('shop_id')]);

        $autoBackup = $request->has('auto_backup') ? true : false;
        $externalPath = $request->external_path;

        // Perform directory write validation if external path is specified
        if (!empty($externalPath)) {
            $extDir = rtrim($externalPath, '/\\');
            if (!file_exists($extDir) || !is_dir($extDir)) {
                return redirect()->back()->with('error', 'The external path directory does not exist. Please specify a valid absolute server path.');
            }
            if (!is_writable($extDir)) {
                return redirect()->back()->with('error', 'The external path directory is not writable. Please check system file permissions.');
            }
        }

        $settings->update([
            'auto_backup' => $autoBackup,
            'external_path' => $externalPath,
            'retention_days' => $request->retention_days,
        ]);

        return redirect()->back()->with('success', 'Backup configuration settings updated successfully!');
    }

    public function runManualBackup()
    {
        $backupService = new \App\Services\BackupService();
        $result = $backupService->run(false); // manual backup

        if ($result['success']) {
            return redirect()->back()->with('success', "Backup archive '{$result['filename']}' ({$result['size']}) compiled and stored successfully!");
        } else {
            return redirect()->back()->with('error', "Backup processing failed: {$result['error']}");
        }
    }

    public function downloadBackup($id)
    {
        $log = \App\Models\BackupLog::findOrFail($id);
        $fullPath = storage_path('app/' . $log->path);

        if (!file_exists($fullPath)) {
            return redirect()->back()->with('error', 'Backup archive file not found on the server.');
        }

        return response()->download($fullPath, $log->filename);
    }

    public function deleteBackup($id)
    {
        $log = \App\Models\BackupLog::findOrFail($id);

        // Delete local file
        $localPath = storage_path('app/' . $log->path);
        if (file_exists($localPath)) {
            unlink($localPath);
        }

        // Delete external file if possible
        if (!empty($log->external_path) && file_exists($log->external_path)) {
            unlink($log->external_path);
        }

        $log->delete();

        return redirect()->back()->with('success', 'Backup archive log and storage file successfully deleted.');
    }

    public function restoreBackup($id)
    {
        $backupService = new \App\Services\BackupService();
        $result = $backupService->restore($id);

        if ($result['success']) {
            $msg = "System successfully restored from backup! (Safety backup compiled as '{$result['safety_backup']}' in {$result['duration']})";
            return redirect()->back()->with('success', $msg);
        } else {
            return redirect()->back()->with('error', "Restore processing failed: {$result['error']}");
        }
    }
}
