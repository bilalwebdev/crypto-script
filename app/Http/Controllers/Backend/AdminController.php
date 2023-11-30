<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Jobs\SendSubscriberEmail;
use App\Jobs\SendSubscriberMail;
use App\Models\Admin;
use App\Models\Subscriber;
use App\Models\Template;
use App\Notifications\DepositNotification;
use App\Notifications\KycUpdateNotification;
use App\Notifications\PlanSubscriptionNotification;
use App\Notifications\TicketNotification;
use App\Notifications\WithdrawNotification;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Manage Admins';

        $data['admins'] = Admin::when($request->search, function ($admin) use ($request) {
            $admin->where(function ($item) use ($request) {

                $item->where('username', $request->search)
                    ->orWhere('email', $request->search);
            });
        })->where('username', '!=', 'admin')->latest()->with('roles')->paginate(Helper::pagination());

        return view('backend.admins.index')->with($data);
    }


    public function create()
    {
        $data['title'] =  'Create Admins';

        $data['roles'] = Role::where('name', '!=', 'admin')->latest()->get();

        return view('backend.admins.create')->with($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:admins,username',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required|array',
            'admin_image' => 'nullable|mimes:jpg,png,jpeg'
        ]);


        $admin =  Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $request->has('admin_image') ? Helper::saveImage($request->admin_image, Helper::filePath('admin')) : ''
        ]);


        $admin->assignRole($request->roles);

        return redirect()->back()->with('success', 'Admin created Successfully');
    }

    public function edit($id)
    {
        $data['admin'] = Admin::where('username', '!=', 'admin')->findOrFail($id);


        $data['title'] =  'Edit Admins';


        $data['roles'] = Role::latest()->get();

        return view('backend.admins.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::where('username', '!=', 'admin')->findOrFail($id);

        $request->validate([
            'username' => 'required|unique:admins,username,' . $admin->id,
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|min:6|confirmed',
            'roles' => 'required|array',
            'admin_image' => 'nullable|mimes:jpg,png,jpeg'
        ]);



        $admin->update([
            'name' => $request->username,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password != null ?  bcrypt($request->password) : $admin->password,
            'image' => $request->has('admin_image') ? Helper::saveImage($request->admin_image, Helper::filePath('admins')) : $admin->image
        ]);


        $admin->syncRoles($request->roles);


        return redirect()->back()->with('success', 'Successfully updated Admins');
    }

    public function notifications()
    {
        $data['notifications'] = auth()->guard('admin')->user()->unreadNotifications()->paginate(Helper::pagination(), ['*'], 'notifications');

        $data['depositNotifications'] = auth()->guard('admin')->user()->unreadNotifications()->where('type', DepositNotification::class)->paginate(Helper::pagination(), ['*'], 'depositNotifications');

        $data['subscriptionNotifications'] = auth()->guard('admin')->user()->unreadNotifications()->where('type', PlanSubscriptionNotification::class)->paginate(Helper::pagination(), ['*'], 'subscriptionNotifications');

        $data['withdrawNotifications'] = auth()->guard('admin')->user()->unreadNotifications()->where('type', WithdrawNotification::class)->paginate(Helper::pagination(), ['*'], 'withdrawNotifications');


        $data['ticketNotifications'] = auth()->guard('admin')->user()->unreadNotifications()->where('type', TicketNotification::class)->paginate(Helper::pagination(), ['*'], 'ticketNotifications');

        $data['kycNotifications'] = auth()->guard('admin')->user()->unreadNotifications()->where('type', KycUpdateNotification::class)->paginate(Helper::pagination(), ['*'], 'kycNotifications');

        $data['title'] = 'Notications';

        return view('backend.notifications')->with($data);
    }

    public function SignlemarkNotification(Request $request, $id)
    {
        $notification = auth()->guard('admin')->user()
            ->unreadNotifications()
            ->where('id', $id)->get();

        $notification->markAsRead();

        return response()->json(['success' => true, 'id' => $request->id]);
    }

    public function changeStatus($id)
    {
        $admin = Admin::find($id);

        $admin->status = !$admin->status;

        $admin->save();

        return response()->json(['success' => true]);
    }

    public function subscribers()
    {
        $title = "Newsletter Subscriber";
        $subscribers = Subscriber::latest()->paginate(Helper::pagination());
        return view('backend.subscriber', compact('subscribers', 'title'));
    }

    public function bulkMail(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        SendSubscriberMail::dispatch($data);

        return redirect()->route('admin.subscribers')->with('success', 'Successfully Send Mail');
    }

    public function singleMail(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        $subscribers = Subscriber::where('email', $request->email)->first();


        $data['subject'] = $request->subject;
        $data['message'] = $request->message;
        $data['email'] = $subscribers->email;
        $data['username'] = $subscribers->email;
        $data['app_name'] = Helper::config()->appname;

        Helper::commonMail($data);

        return redirect()->route('admin.subscribers')->with('success', 'Successfully Send Mail');
    }
}
