<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\shop;
use App\Models\User;
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
        $title = 'Create Shop';
        return view('admin.shops.create', compact('title'));
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
        $title = 'Edit Shop';
        $shopItem = shop::findOrFail($id);
        return view('admin.shops.edit', compact('title', 'shopItem'));
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
}
