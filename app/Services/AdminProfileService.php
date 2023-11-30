<?php

namespace App\Services;

use App\Helpers\Helper\Helper;

class AdminProfileService
{
    public function update($request)
    {
        $admin = auth()->guard('admin')->user();

        if ($request->has('image')) {
            $filename = Helper::saveImage($request->image, Helper::filePath('admin'),$admin->image);

            $admin->image = $filename;
        }

        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->save();


        return ['type' => 'success', 'message' => 'Profile Updated Successfully'];
    }
}
