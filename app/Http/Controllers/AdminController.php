<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\shop;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // =========================================================
    //  AUTH
    // =========================================================

    public function showLogin()
    {
        if (session()->has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function loginCheck(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }

        session(['admin_id' => $admin->id]);
        return redirect()->route('admin.dashboard')->with('success', 'Welcome back, ' . $admin->name . '!');
    }

    public function logout()
    {
        session()->forget('admin_id');
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }

    // =========================================================
    //  DASHBOARD
    // =========================================================

    public function dashboard()
    {
        $title       = 'Admin Dashboard';
        $totalShops  = shop::count();
        $activeShops = shop::where('status', 'active')->count();
        $totalUsers  = User::count();

        return view('admin.dashboard', compact('title', 'totalShops', 'activeShops', 'totalUsers'));
    }

    // =========================================================
    //  SHOPS CRUD
    // =========================================================

    public function shops()
    {
        $title     = 'Manage Shops';
        $shopsList = shop::latest()->get();
        return view('admin.shops.index', compact('title', 'shopsList'));
    }

    public function shopsCreate()
    {
        $title          = 'Create Shop';
        $settings       = Settings::first();
        $googleApiKey   = $settings->google_api_key ?? '';
        return view('admin.shops.create', compact('title', 'googleApiKey'));
    }

    public function shopsStore(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email|unique:shops,email',
            'password' => 'required|min:6',
            'title'    => 'nullable|string|max:255',
            'address'  => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);

        $profilePath = 'default.jpg';
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('shopImages'), $fileName);
            $profilePath = 'shopImages/' . $fileName;
        }

        shop::create([
            'username'     => $request->username,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'title'        => $request->title,
            'description'  => $request->description,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,
            'profile'      => $profilePath,
            'status'       => $request->status ?? 'active',
        ]);

        return redirect()->route('admin.shops.index')->with('success', 'Shop created successfully.');
    }

    public function shopsEdit($id)
    {
        $title          = 'Edit Shop';
        $shopItem       = shop::findOrFail($id);
        $settings       = Settings::first();
        $googleApiKey   = $settings->google_api_key ?? '';
        return view('admin.shops.edit', compact('title', 'shopItem', 'googleApiKey'));
    }

    public function shopsUpdate(Request $request, $id)
    {
        $shopItem = shop::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email|unique:shops,email,' . $id,
            'title'    => 'nullable|string|max:255',
            'address'  => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);

        $profilePath = $shopItem->profile;
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('shopImages'), $fileName);
            $profilePath = 'shopImages/' . $fileName;
        }

        $updateData = [
            'username'     => $request->username,
            'email'        => $request->email,
            'title'        => $request->title,
            'description'  => $request->description,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,
            'profile'      => $profilePath,
            'status'       => $request->status ?? $shopItem->status,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $shopItem->update($updateData);

        return redirect()->route('admin.shops.index')->with('success', 'Shop updated successfully.');
    }

    public function shopsDelete($id)
    {
        $shopItem = shop::findOrFail($id);
        $shopItem->delete();
        return redirect()->route('admin.shops.index')->with('success', 'Shop deleted successfully.');
    }

    public function shopsToggleStatus($id)
    {
        $shopItem = shop::findOrFail($id);
        $shopItem->status = $shopItem->status === 'active' ? 'pending' : 'active';
        $shopItem->save();
        return redirect()->back()->with('success', 'Shop status updated.');
    }

    // =========================================================
    //  SETTINGS
    // =========================================================

    public function settings()
    {
        $title = 'Admin Settings';
        $admin = Admin::findOrFail(session('admin_id'));
        return view('admin.settings.index', compact('title', 'admin'));
    }

    public function updateSettings(Request $request)
    {
        $admin = Admin::findOrFail(session('admin_id'));

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $admin->name  = $request->name;
        $admin->email = $request->email;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect()->back()->with('success', 'Profile settings updated successfully.');
    }

    // =========================================================
    //  APP SETTINGS
    // =========================================================

    public function appSettings()
    {
        $title = 'App Settings';
        $settings = Settings::first() ?? new Settings();
        return view('admin.app_settings.index', compact('title', 'settings'));
    }

    public function updateAppSettings(Request $request)
    {
        $request->validate([
            'google_api_key'      => 'nullable|string',
            'near_by_location'    => 'nullable|string',
            'privacy_policy'      => 'nullable|string',
            'terms_and_condition' => 'nullable|string',
            'about_us'            => 'nullable|string',
        ]);

        $settings = Settings::first();
        if (!$settings) {
            $settings = new Settings();
        }

        $settings->fill($request->all());
        $settings->save();

        return redirect()->back()->with('success', 'App settings updated successfully.');
    }

    // =========================================================
    //  APP USERS
    // =========================================================

    public function appUsers()
    {
        $title        = 'App Users';
        $users        = User::latest()->get();
        $totalUsers   = $users->count();
        $activeUsers  = $users->where('status', 'active')->count();
        $blockedUsers = $users->where('status', 'blocked')->count();
        $pendingUsers = $users->whereNotIn('status', ['active', 'blocked'])->count();

        return view('admin.app_users.index', compact(
            'title', 'users', 'totalUsers', 'activeUsers', 'blockedUsers', 'pendingUsers'
        ));
    }

    public function appUsersCreate()
    {
        $title = 'Add App User';
        return view('admin.app_users.create', compact('title'));
    }

    public function appUsersStore(Request $request)
    {
        $request->validate([
            'full_name'         => 'required|string|max:255',
            'email'             => 'nullable|email|unique:users,email',
            'phone_number'      => 'nullable|string|max:20',
            'password'          => 'required|min:6',
            'status'            => 'required|string',
            'profile_picture'   => 'nullable|image|max:2048',
        ]);

        $picPath = 'default.jpg';
        if ($request->hasFile('profile_picture')) {
            $file    = $request->file('profile_picture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('userImages'), $fileName);
            $picPath = $fileName;
        }

        User::create([
            'full_name'         => $request->full_name,
            'email'             => $request->email,
            'phone_number'      => $request->phone_number,
            'password'          => Hash::make($request->password),
            'registration_type' => 'email',
            'status'            => $request->status,
            'profile_picture'   => $picPath,
        ]);

        return redirect()->route('admin.app_users.index')->with('success', 'User created successfully.');
    }

    public function appUsersEdit($id)
    {
        $title    = 'Edit App User';
        $userItem = User::findOrFail($id);
        return view('admin.app_users.edit', compact('title', 'userItem'));
    }

    public function appUsersUpdate(Request $request, $id)
    {
        $userItem = User::findOrFail($id);

        $request->validate([
            'full_name'         => 'required|string|max:255',
            'email'             => 'nullable|email|unique:users,email,' . $id,
            'phone_number'      => 'nullable|string|max:20',
            'password'          => 'nullable|min:6',
            'status'            => 'required|string',
            'profile_picture'   => 'nullable|image|max:2048',
        ]);

        $picPath = $userItem->profile_picture;
        if ($request->hasFile('profile_picture')) {
            $file     = $request->file('profile_picture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('userImages'), $fileName);
            $picPath  = $fileName;
        }

        $data = [
            'full_name'         => $request->full_name,
            'email'             => $request->email,
            'phone_number'      => $request->phone_number,
            'status'            => $request->status,
            'profile_picture'   => $picPath,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $userItem->update($data);

        return redirect()->route('admin.app_users.index')->with('success', 'User updated successfully.');
    }

    public function appUsersDelete($id)
    {
        $userItem = User::findOrFail($id);
        $userItem->delete();
        return redirect()->route('admin.app_users.index')->with('success', 'User deleted successfully.');
    }

    public function appUsersToggleBlock($id)
    {
        $user         = User::findOrFail($id);
        $user->status = ($user->status === 'blocked') ? 'active' : 'blocked';
        $user->save();

        $msg = $user->status === 'blocked' ? 'User has been blocked.' : 'User has been unblocked.';
        return redirect()->back()->with('success', $msg);
    }
}
