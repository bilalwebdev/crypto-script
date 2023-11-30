<?php

namespace App\Services;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Support\Str;

class PageService
{
    public function create($request)
    {
        $page = Page::create([
            'name' => $request->page,
            'slug' => Str::slug($request->page),
            'order' => $request->order,
            'is_dropdown' => $request->is_dropdown,
            'seo_keywords' => $request->keyword,
            'seo_description' => $request->seo_description,
            'status' => $request->status,
        ]);

        foreach ($request->sections as $section) {
            PageSection::create([
                'page_id' => $page->id,
                'sections' => $section
            ]);
        }

        return ['type' => 'success', 'message' => 'Page Created Successfully'];
    }

    public function update($request)
    {

      

        $page = Page::find($request->id);

        if (!$page) {
            return ['type' => 'error', 'message' => 404];
        }

        $page->update([
            'name' => $request->page,
            'slug' => Str::slug($request->page),
            'order' => $request->order,
            'is_dropdown' => $request->is_dropdown,
            'seo_keywords' => $request->keyword,
            'seo_description' => $request->seo_description,
            'status' => $request->status,
        ]);

        $page->widgets->map(function ($item) {
            $item->delete();
        });


        foreach ($request->sections as $section) {
            PageSection::create([
                'page_id' => $page->id,
                'sections' => $section
            ]);
        }

        return ['type' => 'success', 'message' => 'Page Updated Successfully'];
    }
}
