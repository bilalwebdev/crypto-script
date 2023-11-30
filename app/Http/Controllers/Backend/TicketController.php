<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{

    public function index(Request $request)
    {
        $data['title'] = "All Ticket";

        $tickets = Ticket::query();

        if ($request->user) {
            $tickets->where('user_id', $request->user);
        }

        if ($request->search) {
            $tickets->where('support_id', 'LIKE', '%' . $request->search . '%');
        } elseif ($request->status) {
            $status  = $request->status === 'closed' ? 1 : ($request->status === 'pending' ? 2 : 3);
            $tickets->where('status', $status);
        }

        $data['tickets'] = $tickets->with('ticketReplies', 'user')->latest()->paginate(Helper::pagination());

        return view('backend.ticket.list')->with($data);
    }

    public function filterByStatus(Request $request)
    {
        $data['title'] = "{$request->status} Ticket";

        $tickets = Ticket::query();

        if ($request->status === 'pending') {
            $tickets->where('status', 2);
        } elseif ($request->status === 'answered') {
            $tickets->where('status', 3);
        } else {
            $tickets->where('status', 1);
        }

        $data['tickets'] = $tickets->latest()->with('ticketReplies', 'user')->paginate(Helper::pagination());


        return view('backend.ticket.list')->with($data);
    }

    public function show($id)
    {
        $data['title'] = "Support Ticket Discussion";

        $data['ticket'] = Ticket::find($id);

        $data['ticket_reply'] = TicketReply::whereTicketId($data['ticket']->id)->latest()->with('ticket')->get();

        return view('backend.ticket.show')->with($data);
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        if ($ticket) {
            $all_reply = TicketReply::whereTicketId($id)->get();
            if (count($all_reply) > 0) {
                foreach ($all_reply as $reply) {
                    $item = TicketReply::find($reply->id);
                    if ($item->file) {
                        Helper::removeFile(Helper::filePath('Ticket', true) . $reply->file);
                    }
                    $item->delete();
                }
            }
            $ticket->delete();
        }

        return redirect()->back()->with('success', 'Ticket Deleted Successfully');
    }

    public function reply(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $reply = new TicketReply();
        $reply->ticket_id = $request->ticket_id;
        $reply->admin_id = Auth::guard('admin')->user()->id;
        $reply->message = $request->message;


        if ($request->has('image')) {
            $image = Helper::saveImage($request->image, Helper::filePath('Ticket', true));
            $reply->file = $image;
        }

        $reply->save();

        Ticket::findOrFail($request->ticket_id)->update(['status' => 3]);

        return redirect()->back()->with('success', 'Reply Created Successfully');
    }
}
