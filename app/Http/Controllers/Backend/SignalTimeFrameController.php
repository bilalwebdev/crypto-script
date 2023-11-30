<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\TimeFrame;
use Illuminate\Http\Request;

class SignalTimeFrameController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Manage Time Frame';

        $data['frames'] = TimeFrame::search($request->search)->latest()->paginate(Helper::pagination());

        return view('backend.frame.index')->with($data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:time_frames,name',
            'status' => 'required|in:0,1'
        ]);

        TimeFrame::create($data);

        return redirect()->back()->with('success', 'Time Frame created successfully');
    }

    public function update(Request $request, $id)
    {

        $frame = TimeFrame::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|max:255|unique:time_frames,name,' . $frame->id,
            'status' => 'required|in:0,1'
        ]);

        $frame->update($data);

        return redirect()->back()->with('success', 'Frame updated successfully');
    }

    public function destroy($id)
    {
        $frame = TimeFrame::findOrFail($id);

        $frame->delete();

        return redirect()->back()->with('success', 'Frame Deleted successfully');
    }

    public function changeStatus($id)
    {
        $frame = TimeFrame::findOrFail($id);

        if ($frame->status) {

            $frame->status = false;
        } else {

            $frame->status = true;
        }

        $frame->save();


        $notify = ['success' => 'Status Change Successfully'];

        return response()->json($notify);
    }
}
