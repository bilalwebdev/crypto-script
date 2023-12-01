<?php

namespace App\Http\Controllers;

use App\Helpers\Helper\Helper;
use App\Http\Requests\UserProfile;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\User;
use App\Services\UserDashboardService;
use App\Services\UserProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $profile, $dashboard;



    public function __construct(UserProfileService $profile, UserDashboardService $dashboard)
    {
        $this->profile = $profile;
        $this->dashboard = $dashboard;
    }

    public function dashboard()
    {

        $data = $this->dashboard->dashboard();

        $data['title'] = "Dashboard";

        return view(Helper::theme() . 'user.dashboard')->with($data);
    }
    public function openAccount(Request $request)
    {

        $data['title'] = "Open Account";

        $data['isDemo'] = false;
        if ($request->acc == 'demoacc') {
            $data['isDemo'] = true;
        }

        return view(Helper::theme() . 'user.open_account')->with($data);
    }

    public function deposit(Request $request)
    {

        $user = auth()->user();
        $data['accounts'] = $user->accounts;
        $data['title'] = "Deposit";
        $data['payment_methods'] = Gateway::where('status', 1)->get();

        if ($request->all()) {

            $request->validate([
                'payment_method_id' => 'required',
                'amount' => 'required',
                'login' => 'required',
            ]);

            Deposit::create([
                'user_id' => Auth::id(),
                'payment_method_id' => $request->payment_method_id,
                'amount' => $request->amount,
                'login' => $request->login,
                'status' => 2
            ]);

            session()->flash('success', 'deposit resquest sent successfully!');

            return redirect('/deposit');
        }


        return view(Helper::theme() . 'user.deposit')->with($data);
    }
    public function createDeposit()
    {
        $user = auth()->user();



        return view(Helper::theme() . 'user.deposit')->with($data);
    }

    public function getAccount(Request $request)
    {


        if ($request->login) {
            return $this->dashboard->getAccount($request->login);
        }
    }

    public function withdraw()
    {
        $user = auth()->user();
        $data['accounts'] = $user->accounts;
        $data['title'] = 'Withdraw';

        return view(Helper::theme() . 'user.withdraw.index')->with($data);
    }
    public function history()
    {
        $data['title'] = 'History';

        return view(Helper::theme() . 'user.history')->with($data);
    }

    public function profile()
    {
        $data['title'] = 'Profile Edit';

        $data['user'] = auth()->user();

        return view(Helper::theme() . 'user.profile')->with($data);
    }

    public function profileUpdate(UserProfile $request)
    {

        $isSuccess = $this->profile->update($request);

        if ($isSuccess['type'] === 'success')
            return back()->with('success', $isSuccess['message']);
    }

    public function changePassword()
    {
        $title = 'Change Password';
        return view(Helper::theme() . 'user.changepassword', compact('title'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required|min:6',
            'password' => 'min:6|confirmed',
        ]);

        $user = User::find(auth()->id());

        if (!Hash::check($request->oldpassword, $user->password)) {
            return redirect()->back()->with('error', 'Old password do not match');
        } else {
            $user->password = bcrypt($request->password);

            $user->save();

            return redirect()->back()->with('success', 'Password Updated');
        }
    }
}
