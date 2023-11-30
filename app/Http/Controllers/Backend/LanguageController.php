<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Content;
use App\Models\Language;
use App\Services\LanguageService;
use App\Utility\ElementBuilder;
use App\Utility\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class LanguageController extends Controller
{
    protected $language;

    public function __construct(LanguageService $language)
    {
        $this->language = $language;
    }

    public function index()
    {
        $data['title'] = "Language Settings";

        $data['languages'] = Language::latest()->paginate(Helper::pagination());

        return view('backend.language.index')->with($data);
    }

    public function store(LanguageRequest $request)
    {
        $isSuccess = $this->language->create($request);

        if ($isSuccess['type'] === 'success')

            return redirect()->back()->with('success', $isSuccess['message']);
    }

    public function update(Request $request)
    {
        $isSuccess = $this->language->update($request);
        if ($isSuccess['type'] === 'error') {
            return back()->with('error', $isSuccess['message']);
        }

        return back()->with('success', $isSuccess['message']);
    }

    public function delete(Request $request)
    {

        $isSuccess = $this->language->delete($request);

        if ($isSuccess['type'] === 'error') {

            return redirect()->back()->with('error', $isSuccess['message']);
        }

        return redirect()->back()->with('success', $isSuccess['message']);
    }


    public function transalate(Request $request)
    {
        $data['title'] = "Language Translator";

        $data['languages'] = Language::where('code', '!=', $request->lang)->get();

        $language = Language::where('code', $request->lang)->firstOrFail();

        $data['translators'] = collect(json_decode(file_get_contents(resource_path() . "/lang/$language->code.json"), true));

        $data['frontendtranslators'] = collect(json_decode(file_get_contents(resource_path() . "/lang/sections/$language->code.json"), true));

        $data['all'] = $data['translators'];

        return view('backend.language.translate')->with($data);
    }


    public function transalateUpate(Request $request)
    {



        $request->validate([
            'key' => 'required',
            'value' => 'required',
        ]);

        $language = Language::where('code', $request->lang)->firstOrFail();


        $trans = json_decode(file_get_contents(resource_path() . "/lang/$language->code.json"), true);

        $trans[$request->key] = $request->value;


        file_put_contents(resource_path() . "/lang/$language->code.json", json_encode($trans));

        return back();
    }


    public function ajaxUpdate(Request $request)
    {

        $language = Language::where('code', $request->lang)->first();

        $trans = array_combine($request->key, $request->value);
        


        if ($request->type == 'section') {
            $previous = json_decode(file_get_contents(resource_path() . "/lang/sections/$language->code.json"), true);
        } else {

            $previous = json_decode(file_get_contents(resource_path() . "/lang/$language->code.json"), true);
        }



        $final = $trans + $previous;


        if ($request->type == 'section') {
            file_put_contents(resource_path() . "/lang/sections/$language->code.json", json_encode($final));
        } else {

            file_put_contents(resource_path() . "/lang/$language->code.json", json_encode($final));
        }



        return redirect()->back()->with('success', 'Language Key value update successfully');
    }

    public function deleteKey(Request $request)
    {
        $language = Language::where('code', $request->lang)->first();

        if ($request->type == 'section') {
            $previous = json_decode(file_get_contents(resource_path() . "/lang/sections/$language->code.json"), true);
        } else {

            $previous = json_decode(file_get_contents(resource_path() . "/lang/$language->code.json"), true);
        }


        unset($previous[$request->key]);

        if ($request->type == 'section') {
            file_put_contents(resource_path() . "/lang/$language->code.json", json_encode($previous));
        } else {

            file_put_contents(resource_path() . "/lang/$language->code.json", json_encode($previous));
        }

        return redirect()->back()->with('success', 'Language Key value Deleted successfully');
    }

    public function changeLang(Request $request)
    {
        App::setLocale($request->lang);

        session()->put('locale', $request->lang);

        return redirect()->back()->with('success', __('Successfully Changed Language'));
    }
}
