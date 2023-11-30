<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Services\AdminProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{

    protected $profile;

    public function __construct(AdminProfileService $profile)
    {
        $this->profile = $profile;
    }

    public function profile()
    {
        $data['title'] = 'Profile Settings';

        return view('backend.profile')->with($data);
    }

    public function profileUpdate(AdminProfileRequest $request)
    {
        $isSuccess = $this->profile->update($request);

        if ($isSuccess['type'] === 'success')
            return redirect()->back()->with('success', $isSuccess['message']);
    }


    public function changePassword(Request $request)
    {
        session()->put('type', 'password');

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $admin = auth()->guard('admin')->user();

        if (!Hash::check($request->old_password, $admin->password)) {
            return back()->with('error', 'Password Does not match');
        }

        $admin->password = bcrypt($request->password);
        $admin->save();

        return back()->with('success', 'Password changed Successfully');
    }
}
