<?php

namespace App\Services;

use App\Helpers\Helper\Helper;
use App\Models\Content;
use App\Models\FrontendMedia;
use App\Models\Language;
use App\Utility\ElementBuilder;
use App\Utility\FormBuilder;

class SectionManagerService
{
    public function contentUpdate($request)
    {

        $builder = FormBuilder::classMap(request()->name);


        $data = $request->except('_token');

        $content = Content::where('name', request()->name)->where('theme', Helper::config()->theme)->where('type', 'non_iteratable')->first();


        foreach ($builder->image_upload_ids as $name) {
            if (request()->has($name)) {
                if (isset($content->content->$name)) {
                    $data[$name] = Helper::saveImage($request->$name, Helper::filePath(request()->name), $content->content->$name);
                } else {
                    $data[$name] = Helper::saveImage($request->$name, Helper::filePath(request()->name));
                }
            } else {
                if ($content) {

                    $data[$name] = optional($content->content)->$name;
                }
            }
        }


        if (!$content) {
            $content = new Content();
        }

        $content->type = 'non_iteratable';
        $content->name = request()->name;
        $content->content = $data;
        $content->theme = Helper::config()->theme;

        $content->save();


        return ['type' => 'success', 'message' => request()->name . " Updated Successfully"];
    }

    public function elementCreate($request)
    {

        $builder = FormBuilder::classMap(request()->name);

        $data = $request->except('_token');

        $content = new Content();

        foreach ($builder->image_upload_ids as $name) {
            if (request()->has($name)) {
                $data[$name] = Helper::saveImage($request->$name, Helper::filePath(request()->name));
            }
        }

        $content->type = 'iteratable';
        $content->name = request()->name;
        $content->content = $data;
        $content->theme = Helper::config()->theme;
        $content->save();

        return ['type' => 'success', 'message' => request()->name . " Updated Successfully"];
    }

    public function elementUpdate($request, $content)
    {
        $builder = FormBuilder::classMap(request()->name);

        $data = $request->except('_token');


        
        foreach ($builder->image_upload_ids as $name) {

            if(array_key_exists($name, $builder->elementFields[Helper::config()->theme])){

                if (!$content) {
                    if (request()->has($name)) {
                        $data[$name] = Helper::saveImage($request->$name, Helper::filePath(request()->name));
                    }
                }else{
                    if (request()->has($name)) {
                        $data[$name] = Helper::saveImage($request->$name, Helper::filePath(request()->name), optional($content->content)->$name);
                    }else{
                        $data[$name] = $content->content->$name;
                    }
                }
            }
        }



        $content->type = 'iteratable';
        $content->name = $content->name;
        $content->content = $data;
        $content->theme = Helper::config()->theme;
        $content->save();

        return ['type' => 'success', 'message' => request()->name . " Updated Successfully"];
    }

    public function deleteElement($content)
    {
        $builder = FormBuilder::classMap(request()->name);

        foreach ($builder->elementFields[Helper::config()->theme] as $key => $value) {
            if ($value === 'Upload') {
                if (optional($content->content)->$key != null) {
                    Helper::removeFile(Helper::filePath($content->name) . '/' . $content->content->$key);
                }
            }
        }
        $content->delete();

        return ['type' => 'success', 'message' => request()->name . " Deleted Successfully"];
    }
}
