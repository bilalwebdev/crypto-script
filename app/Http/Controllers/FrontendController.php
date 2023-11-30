<?php
namespace App\Http\Controllers;

use App\Helpers\Helper\Helper;
use App\Models\Configuration;
use App\Models\Content;
use App\Models\Page;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Services\MT5\MT5Service;



class FrontendController extends Controller
{

    protected $mt5Service;
    public function __construct(MT5Service $mt5Service){
        $this->mt5Service = $mt5Service;   
    }

    public function index()
    {


        $data['page'] = Page::where('name', 'home')->first();

        $data['title'] = $data['page']->name;

        return view(Helper::theme() . 'home')->with($data);
    }

    public function page(Request $request)
    {
        $data['page'] = Page::where('slug', $request->pages)->first();

        if (!$data['page']) {
            abort(404);
        }

        $data['title'] = "{$data['page']->name}";

        return view(Helper::theme() . 'pages')->with($data);
    }

    public function changeLanguage(Request $request)
    {
        App::setLocale($request->lang);

        session()->put('locale', $request->lang);

        return redirect()->back()->with('success', __('Successfully Changed Language'));
    }

    public function blogDetails($id)
    {
        $theme = Configuration::first()->theme;

        $data['title'] = "Recent Blog";
        $data['blog'] = Content::where('theme', $theme)->where('name', 'blog')->where('id', $id)->first();

        $data['recentblog'] = Content::where('theme', $theme)->where('name', 'blog')->where('type', 'iteratable')->latest()->limit(6)->paginate(Helper::pagination());

        $data['shareComponent'] = \Share::page(
            url()->current(),
            'Share',
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();

        return view(Helper::theme() . 'pages.blog_details')->with($data);
    }

    public function contactSend(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $data = [
            'subject' => $request->subject,
            'message' => $request->message
        ];

        Helper::commonMail($data);

        return back()->with('success', 'Contact With us successfully');
    }

    public function subscribe(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:subscribers',
        ]);

        Subscriber::create([
            'email' => $request->email
        ]);

        return response()->json(['success' => true]);
    }

    public function linksDetails($id)
    {
        $details = Content::findOrFail($id);

        $data['title'] = $details->content->page_title;
        $data['details'] = $details;

        return view(Helper::theme(). 'link_details')->with($data);
    }
}
