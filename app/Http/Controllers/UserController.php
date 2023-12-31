<?php

namespace App\Http\Controllers;

use App\Helpers\Helper\Helper;
use App\Http\Requests\UserProfile;
use App\Models\Account;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\KycDocs;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\UserPaymentMethod;
use App\Models\Withdraw;
use App\Services\UserDashboardService;
use App\Services\UserProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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


        if ($request->all()) {

            $request->validate([
                'investor_pass' => ['required', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()],
                'master_pass' => ['required', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()]
            ]);

            $res =  $this->dashboard->openAccount($request->leverage, $request->investor_pass, $request->master_pass);

            $data['acc_created'] = Account::create([
                'user_id' => Auth::id(),
                'login' => $res['login'],
                'account_type' => $request->acc_type,
                'currency' => 'usd',
                'account-leverage' => $request->leverage,
                'investor_pass' => $request->investor_pass,
                'master_pass' => $request->master_pass,
            ]);

            session()->flash('success', 'Account created successfully!');
            return view(Helper::theme() . 'user.open_account_success')->with($data);
        }


        return view(Helper::theme() . 'user.open_account')->with($data);
    }

    public function deposit(Request $request)
    {

        $user = auth()->user();
        $data['accounts'] = $user->accounts;
        $data['title'] = "Deposit";
        $data['payment_methods'] = PaymentMethod::where('status', 1)->get()->toArray();

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

            session()->flash('success', 'Deposit request sent successfully!');


            return redirect('/history')->with($data);
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

    public function withdraw(Request $request)
    {

        $user = auth()->user();
        $data['accounts'] = $user->accounts;
        $data['payment_methods'] = UserPaymentMethod::where('status', 1)->get()->toArray();
        $data['title'] = 'Withdraw';


        if ($request->all()) {

            $request->validate([
                'payment_method_id' => 'required',
                'amount' => 'required',
                'login' => 'required',
            ]);

            Withdraw::create([
                'user_id' => Auth::id(),
                'payment_method_id' => $request->payment_method_id,
                'amount' => $request->amount,
                'login' => $request->login,
                'status' => 2
            ]);

            session()->flash('success', 'Withdraw request sent successfully!');

            $data['type'] = 'with';

            return redirect('/history')->with($data);
        }

        return view(Helper::theme() . 'user.withdraw.index')->with($data);
    }
    public function history(Request $request)
    {
        $data['title'] = 'History';

        $user = auth()->user();
        $data['accounts'] = $user->accounts;
        $data['login'] = '';

        if ($request->type == 'with') {
            $query = Withdraw::where('user_id', Auth::id());
            $data['type'] = 'with';
        }
        if ($request->type == 'dep' || $request->type == '') {
            $query = Deposit::where('user_id', Auth::id());
            $data['type'] = 'dep';
        }

        if ($request->login) {

            $query =  $query->where('login', $request->login);
            $data['login'] = $request->login;
        }

        $query =  $query->with('payment');
        $query =  $query->paginate(10);
        $data['requests'] = $query;



        return view(Helper::theme() . 'user.history')->with($data);
    }
    public function historyDel($id, $type)
    {
        $data['title'] = 'History';

        if ($type == 'dep') {
            Deposit::where('id', $id)->delete();
            session()->flash('success', 'Deposit request deleted successfully!');
        } else {
            Withdraw::where('id', $id)->delete();
            session()->flash('success', 'Withdraw request deleted successfully!');
        }
        //  dd($data['deposit_requests']);

        return redirect('/history');
    }

    public function profile()
    {

        $data['title'] = 'Profile Edit';

        $data['user'] = auth()->user();

        $data['docs'] = KycDocs::where('user_id', Auth::id())->get();

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

    public function KYCFileUpload(Request $request)
    {

        // dd($request->all());

        if ($request->hasFile('file')) {
            $filename = Helper::saveImage($request->file, Helper::filePath('kyc', true));
            // $user->image = $filename;
        }

        KycDocs::create([
            'user_id' => Auth::id(),
            'file' => $filename,
            'type' => $request->doc_type,

        ]);

        return redirect()->back()->with('success', 'File Uploaded');
    }

    public function openAccountSuccess()
    {
        return view('frontend.light.user.open_account_success');
    }
}
