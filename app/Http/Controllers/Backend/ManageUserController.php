<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;
use App\Jobs\SendEmailJob;
use App\Jobs\SendQueueEmail;
use App\Models\Admin;
use App\Models\AdminUser;
use App\Models\GeneralSetting;
use App\Models\KycDocs;
use App\Models\Payment;
use App\Models\ReferralCommission;
use App\Models\Template;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdraw;
use App\Services\AdminUserService;
use App\Services\MT5\MT5Service;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ManageUserController extends Controller
{

    protected $userservice, $mt5service;

    public function __construct(AdminUserService $userservice, MT5Service $mT5Service)
    {
        $this->userservice = $userservice;
        $this->mt5service = $mT5Service;
    }

    public function index(Request $request)
    {
        $data['title'] = 'All Users';

        $admin  = Admin::find(session()->get('user_id'));


        if ($admin->type == 'super') {
            $users = User::query();
        } else {
            $users = User::leftJoin('admin_users', 'users.id', '=', 'admin_users.user_id')
                ->where('admin_users.admin_id', '=', session()->get('user_id'))
                ->select('users.*');
        }


        if ($request->search) {
            $users->where(function ($item) use ($request) {
                $item->where('username', $request->search)
                    ->orWhere('email', $request->email)
                    ->orWhere('phone', $request->search);
            });
        }

        if ($request->user_status) {
            $status = $request->user_status === 'user_active' ? 1 : 0;
            $users->where('status', $status);
        }




        $data['users'] = $users->latest()->paginate(Helper::pagination());

        return view('backend.users.index')->with($data);
    }

    public function userDetails(Request $request)
    {



        $data['user'] = User::with('refferals')->where('id', $request->user)->firstOrFail();

        // $data['payment'] = Payment::where('user_id', $data['user']->id)->where('status', 1)->latest()->first();

        // $data['totalRef'] = $data['user']->refferals->count();

        // $data['userCommission'] = $data['user']->commissions->sum('amount');

        // $data['withdrawTotal'] = Withdraw::where('user_id', $data['user']->id)->where('status', 1)->sum('amount');

        // $data['totalDeposit'] = $data['user']->deposits()->where('status', 1)->sum('amount');

        // $data['totalInvest'] = $data['user']->payments()->where('status', 1)->sum('amount');

        // $data['totalTicket'] = $data['user']->tickets->count();

        $data['title'] = "User Details";

        $data['mt5'] = new MT5Service();


        return view('backend.users.details')->with($data);
    }

    public function userUpdate(AdminUserRequest $request)
    {
        $isSuccess = $this->userservice->update($request);

        if ($isSuccess['type'] === 'success')
            return back()->with('success', $isSuccess['message']);
    }

    public function sendUserMail(Request $request, User $user)
    {


        $data = $request->validate([
            'subject' => 'required',
            "message" => 'required',
        ]);


        $data['name'] = $user->username;
        $data['subject'] = $request->subject;
        $data['message'] = $request->message;
        $data['email'] = $user->email;
        $data['username'] = $user->username;
        $data['app_name'] = Helper::config()->appname;

        Helper::commonMail($data);



        return back()->with('success', 'Send Email To user Successfully');
    }

    public function disabled(Request $request)
    {
        $title = 'Disabled Users';

        $search = $request->search;

        $users = User::when($search, function ($q) use ($search) {
            $q->where('username', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $search . '%');
        })->where('status', 0)->latest()->paginate(Helper::pagination());

        return view('backend.users.index', compact('title', 'users'));
    }

    public function userStatusWiseFilter(Request $request)
    {

        $data['title'] = ucwords($request->status) . ' Users';
        $users = User::query();
        if ($request->search) {
            $users->where(function ($item) use ($request) {
                $item->where('username', $request->search)
                    ->orWhere('email', $request->email)
                    ->orWhere('phone', $request->search);
            });
        }
        if ($request->user_status) {
            $status = $request->user_status === 'user_active' ? 1 : 0;
            $users->where('status', $status);
        }

        if ($request->status == 'active') {
            $users->where('status', 1);
        } elseif ($request->status == 'deactive') {
            $users->where('status', 0);
        } elseif ($request->status === 'email-unverified') {
            $users->where('is_email_verified', 0);
        } elseif ($request->status === 'sms-unverified') {
            $users->where('is_sms_verified', 0);
        } elseif ($request->status === 'kyc-unverified') {
            $users->whereIn('is_kyc_verified', [0, 2]);
        }


        $data['users'] = $users->paginate(Helper::pagination());



        return view('backend.users.index')->with($data);
    }

    public function interestLog()
    {
        $title = "User Interest Log";
        $interestLogs = ReferralCommission::latest()->paginate();

        return view('backend.userinterestlog', compact('interestLogs', 'title'));
    }

    public function userBalanceUpdate(Request $request)
    {

        $request->validate([
            'balance' => 'required|numeric'
        ]);

        $isSuccess = $this->userservice->updateBalance($request);

        if ($isSuccess['type'] === 'error') {
            return back()->with('error', $isSuccess['message']);
        }

        return back()->with('success', $isSuccess['message']);
    }

    public function loginAsUser($id)
    {
        $user = User::findOrFail($id);

        Auth::loginUsingId($user->id);

        return redirect()->route('user.dashboard');
    }

    public function kycAll(Request $request)
    {
        $user = User::query();

        if ($request->search) {
            $user->where(function ($item) use ($request) {
                $item->where('username', $request->search)
                    ->orWhere('email', $request->email)
                    ->orWhere('phone', $request->search);
            });
        }

        if ($request->user_status) {
            $status = $request->user_status === 'user_active' ? 1 : 0;
            $user->where('status', $status);
        }


        $data['infos'] = $user->where('is_kyc_verified', 2)->paginate(Helper::pagination());

        //   $data['infos'] = KycDocs::all();

        $data['title'] = 'KYC Requests';

        return view('backend.users.kyc_req')->with($data);
    }

    public function kycDetails($id)
    {
        $data['user'] = User::findOrFail($id);

        $data['title']  = 'KYC Details';

        return view('backend.users.kyc_details')->with($data);
    }

    public function kycStatus(Request $req)
    {

        //dd($req->all());
        $user = User::findOrFail($req->user_id);

        foreach ($req->docs as $id) {
            KycDocs::where('user_id', $user->id)
                ->where('id', $id)
                ->update([
                    'status' => 1
                ]);
        }
        $user->is_kyc_verified = 1;
        //  dd($user);
        $user->save();

        return back()->with('success', 'Verified successfully!');
    }

    public function bulkMail(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        SendEmailJob::dispatch($data);

        return redirect()->route('admin.user.index')->with('success', 'Successfully Send Mail');
    }

    public function kycDoc($id)
    {


        $data['info'] = User::where('id', $id)->with('kycinfo')->first()->toArray();

        $data['title']  = 'KYC Details';
        //  $data['infos'] = $user['kyc_information'];



        return view('backend.users.kyc_details')->with($data);
    }

    public function accDel($login)
    {
        $this->mt5service->deleteAccount($login);
        return back()->with('success', 'Deleted successfully!');
    }

    public function userEdit(Request $request)
    {
        $data['user'] = User::with('refferals')->where('id', $request->user)->firstOrFail();

        $data['payment'] = Payment::where('user_id', $data['user']->id)->where('status', 1)->latest()->first();

        $data['totalRef'] = $data['user']->refferals->count();

        $data['userCommission'] = $data['user']->commissions->sum('amount');

        $data['withdrawTotal'] = Withdraw::where('user_id', $data['user']->id)->where('status', 1)->sum('amount');

        $data['totalDeposit'] = $data['user']->deposits()->where('status', 1)->sum('amount');

        $data['totalInvest'] = $data['user']->payments()->where('status', 1)->sum('amount');

        $data['totalTicket'] = $data['user']->tickets->count();


        $data['admins'] = Admin::whereNull('type')->select('id', 'username')->pluck('username', 'id')->toArray();
        //  dd($data['admins']);>
        $data['admin_users'] = AdminUser::where('user_id', $data['user']->id)->pluck('user_id', 'admin_id')->toArray();
        //dd($data['admin_users']);

        $data['title']  = 'Update User';

        return view('backend.users.edit')->with($data);
    }
}
