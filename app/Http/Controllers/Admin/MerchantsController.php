<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MerchantsController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        $merchants = Merchant::with('user')->get();
        return view('admin.merchants.index', compact('merchants'));
    }

    // ================= CREATE =================
    public function create()
    {
        return view('admin.merchants.create');
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:merchants,email|unique:users,email',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
            'verified' => 'boolean',
            'nid_number' => 'nullable|string|max:50',
            'nid_front' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nid_back' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // FILE UPLOAD
        $logoName = null;
        $nidFrontName = null;
        $nidBackName = null;

        if ($request->hasFile('logo')) {
            $logoName = time().'_logo.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/students'), $logoName);
        }

        if ($request->hasFile('nid_front')) {
            $nidFrontName = time().'_nid_front.'.$request->nid_front->extension();
            $request->nid_front->move(public_path('uploads/students'), $nidFrontName);
        }

        if ($request->hasFile('nid_back')) {
            $nidBackName = time().'_nid_back.'.$request->nid_back->extension();
            $request->nid_back->move(public_path('uploads/students'), $nidBackName);
        }

        // CREATE USER
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student', // 🔥 changed
        ]);

        // CREATE STUDENT (merchant model reused)
        Merchant::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'verified' => $request->verified ?? false,
            'nid_number' => $request->nid_number,
            'nid_front' => $nidFrontName,
            'nid_back' => $nidBackName,
            'logo' => $logoName,
        ]);

        return redirect()->route('admin.merchant.list')
            ->with('success', 'Student created successfully.');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $merchant = Merchant::with('user')->findOrFail($id);
        return view('admin.merchants.edit', compact('merchant'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $merchant = Merchant::with('user')->findOrFail($id);
        $user = $merchant->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:merchants,email,$id|unique:users,email,".($user?->id ?? '0'),
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
            'verified' => 'boolean',
            'nid_number' => 'nullable|string|max:50',
            'nid_front' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nid_back' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // FILE UPDATE
        if ($request->hasFile('logo')) {
            if ($merchant->logo && file_exists(public_path('uploads/students/'.$merchant->logo))) {
                unlink(public_path('uploads/students/'.$merchant->logo));
            }

            $merchant->logo = time().'_logo.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/students'), $merchant->logo);
        }

        if ($request->hasFile('nid_front')) {
            if ($merchant->nid_front && file_exists(public_path('uploads/students/'.$merchant->nid_front))) {
                unlink(public_path('uploads/students/'.$merchant->nid_front));
            }

            $merchant->nid_front = time().'_nid_front.'.$request->nid_front->extension();
            $request->nid_front->move(public_path('uploads/students'), $merchant->nid_front);
        }

        if ($request->hasFile('nid_back')) {
            if ($merchant->nid_back && file_exists(public_path('uploads/students/'.$merchant->nid_back))) {
                unlink(public_path('uploads/students/'.$merchant->nid_back));
            }

            $merchant->nid_back = time().'_nid_back.'.$request->nid_back->extension();
            $request->nid_back->move(public_path('uploads/students'), $merchant->nid_back);
        }

        // UPDATE STUDENT
        $merchant->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'verified' => $request->verified ?? false,
            'nid_number' => $request->nid_number,
        ]);

        // UPDATE USER
        if ($user) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('admin.merchant.list')
            ->with('success', 'Student updated successfully.');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $merchant = Merchant::with('user')->findOrFail($id);
        $user = $merchant->user;

        foreach (['logo','nid_front','nid_back'] as $file) {
            if ($merchant->$file && file_exists(public_path('uploads/students/'.$merchant->$file))) {
                unlink(public_path('uploads/students/'.$merchant->$file));
            }
        }

        if ($user) $user->delete();
        $merchant->delete();

        return redirect()->route('admin.merchant.list')
            ->with('success', 'Student deleted successfully.');
    }
}