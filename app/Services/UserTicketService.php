<?php

namespace App\Services;

use App\Helpers\Helper\Helper;
use App\Models\Admin;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Notifications\TicketNotification;

class UserTicketService
{
    public function create($request)
    {
        $ticket = new Ticket();
        $ticket->support_id = '#' . rand(1000, 9999);
        $ticket->user_id =  auth()->user()->id;
        $ticket->subject = $request->subject;
        $ticket->status = 2;
        $ticket->save();

        $reply = new TicketReply();
        $reply->ticket_id = $ticket->id;
        $reply->message = $request->message;

        if ($request->has('file')) {
            $image = Helper::saveImage($request->file, Helper::filePath('Ticket', true), true);
            $reply->file = $image;
        }

        $reply->save();


        $ticket->reply_id = $reply->id;

        $ticket->save();


        $admin = Admin::where('username', 'admin')->first();


        $admin->notify(new TicketNotification($ticket));

        return ['type' => 'success', 'message' => 'Successfully Created Ticket'];
    }


    public function update($request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->support_id = $ticket->support_id;
        $ticket->user_id =  auth()->user()->id;
        $ticket->subject = $request->subject;
        $ticket->status = 2;
        $ticket->save();


        $reply = TicketReply::find($ticket->reply_id);
        $reply->ticket_id = $ticket->id;
        $reply->message = $request->message;

        if ($request->has('file')) {
            $image = Helper::saveImage($request->file, Helper::filePath('Ticket', true));
            $reply->file = $image;
        }

        $reply->save();

        return ['type' => 'success', 'message' => 'Successfully Updated Ticket'];

    }


    public function delete($id)
    {
        $ticket = Ticket::find($id);
        if ($ticket) {
            $all_reply = TicketReply::whereTicketId($id)->get();
            if (count($all_reply) > 0) {
                foreach ($all_reply as $reply) {
                    $item = TicketReply::find($reply->id);
                    if ($item->file) {
                        Helper::removeFile(Helper::filePath('Ticket', true) . '/' . $reply->file);
                    }
                    $item->delete();
                }
            }
            $ticket->delete();
        }

        return ['type' => 'success', 'message' => 'Successfully Deleted Ticket'];
    }

    public function reply($request)
    {
        $reply = new TicketReply();
        $reply->ticket_id = $request->ticket_id;
        $reply->message = $request->message;

        if ($request->has('file')) {
            $image = Helper::saveImage($request->file, Helper::filePath('Ticket', true));
            $reply->file = $image;
        }

        $reply->save();

        return ['type' => 'success', 'message' => 'Successfully Replied'];
    }
}
