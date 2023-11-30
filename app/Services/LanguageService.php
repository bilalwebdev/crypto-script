<?php

namespace App\Services;

use App\Models\Content;
use App\Models\Language;

class LanguageService
{
    public function create($request)
    {
        Language::create([
            'name' => $request->language,
            'code' => $request->code,
            'status' => 1
        ]);

        $path = resource_path('lang/');
        $sectionPath = resource_path('lang/sections/');

        fopen($path . "$request->code.json", "w");
        fopen($sectionPath . "$request->code.json", "w");

        file_put_contents($path . "$request->code.json", '{}');
        file_put_contents($sectionPath . "$request->code.json", '{}');

        return ['type' => 'success', 'message' => 'Language Created Successfully'];
    }

    public function update($request)
    {
        $language = Language::find($request->id);

        if (!$language) {
            return ['type' => 'error', 'message' => 'Language Not Found'];
        }


        $language->update([
            'name' => $request->language,
            'code' => $request->code
        ]);

        $path = resource_path() . "/lang/$language->code.json";

        $sectionPath = resource_path() . "/lang/sections/$language->code.json";



        if (file_exists($sectionPath)) {

            $file_data = json_encode(file_get_contents($sectionPath));

            unlink($sectionPath);

            file_put_contents($sectionPath, json_decode($file_data));
        } else {

            fopen(resource_path('lang/sections/') . "$request->code.json", "w");

            file_put_contents(resource_path() . "/lang/sections/$request->code.json", '{}');
        }


        if (file_exists($path)) {

            $file_data = json_encode(file_get_contents($path));

            unlink($path);

            file_put_contents($path, json_decode($file_data));
        } else {

            fopen(resource_path() . "/lang/$request->code.json", "w");

            file_put_contents(resource_path() . "/lang/$request->code.json", '{}');
        }

        return ['type' => 'success', 'message' => 'Language Updated Successfully'];
    }

    public function delete($request)
    {
        $language = Language::find($request->id);

        if (!$language) {
            return ['type' => 'error', 'message' => 'Language Not Found'];
        }

        Content::where('language_id', $language->id)->get()->map(function ($item) {
            $item->delete();
        });

        if ($language->is_default) {
            return ['type' => 'error', 'message' => 'Default Language Can not Deleted'];
        }

        $path = resource_path() . "/lang/$language->code.json";

        if (file_exists($path)) {
            unlink($path);
        }


        $sectionPath = resource_path() . "/lang/sections/$language->code.json";

        if (file_exists($sectionPath)) {
            unlink($sectionPath);
        }



        if (session('locale') == $language->code) {

            session()->forget('locale');
        }

        $language->delete();


        return ['type' => 'success', 'message' => 'Language Deleted Successfully'];
    }
}
