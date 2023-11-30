<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationRequest;
use App\Models\Configuration;
use App\Services\ConfigurationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ConfigurationController extends Controller
{
    protected $config;

    public function __construct(ConfigurationService $config)
    {
        $this->config = $config;
    }

    public function index()
    {
        $data['title'] = 'Application Settings';

        $data['general'] = Configuration::first();

        $data['timezone'] = json_decode(file_get_contents(resource_path('views/backend/setting/timezone.json')));
        return view('backend.setting.index')->with($data);
    }

    public function ConfigurationUpdate(ConfigurationRequest $request)
    {

        $isSuccess = $this->config->general($request);

        if ($isSuccess['type'] == 'success')
            return back()->with('success', $isSuccess['message']);
    }


    public function cacheClear()
    {

        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');

        return back()->with('success', 'Caches cleared successfully!');
    }

    public function manageTheme()
    {
        $data['title'] = 'Manage Theme';
        return view('backend.setting.theme')->with($data);
    }

    public function themeUpdate($name)
    {
        $general = Configuration::first();

        $general->theme = $name;

        $general->save();

        return redirect()->back()->with('success', 'Template Actived successfully');
    }

    public function themeColor(Request $request)
    {
        $general = Configuration::first();

        $color = is_array($general->color) ? $general->color :  [];


        $color[$request->theme] = $request->color;


        $general->color = $color;

        $general->save();


        return response()->json(['success' => true]);
    }
}
