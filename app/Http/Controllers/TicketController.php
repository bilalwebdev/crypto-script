<?php

namespace App\Http\Controllers;

use App\Helpers\Helper\Helper;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Services\UserTicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    protected $ticket;
    public function __construct(UserTicketService $ticket)
    {
        $this->ticket = $ticket;
    }

    public function index()
    {
        $data['title'] = "Support Ticket";
        $data['tickets'] = Ticket::whereUserId(Auth::user()->id)->with('ticketReplies')->paginate();
        $data['tickets_pending'] = Ticket::whereUserId(Auth::user()->id)->whereStatus('2')->count();
        $data['tickets_answered'] = Ticket::whereUserId(Auth::user()->id)->whereStatus('3')->count();
        $data['tickets_closed'] = Ticket::whereUserId(Auth::user()->id)->whereStatus('1')->count();
        $data['tickets_all'] = Ticket::whereUserId(Auth::user()->id)->count();

        return view(Helper::theme() . 'user.ticket.list')->with($data);
    }


    public function store(TicketRequest $request)
    {
        $isSuccess = $this->ticket->create($request);

        if ($isSuccess['type'] === 'success')
            return redirect()->route('user.ticket.index')->with('success', $isSuccess['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = "Support Ticket Discussion";
        $data['ticket'] = Ticket::find($id);
        $data['tickets'] =  $data['tickets'] = Ticket::whereUserId(Auth::user()->id)->with('ticketReplies')->get();
        $data['ticket_reply'] = TicketReply::whereTicketId($data['ticket']->id)->latest()->get();

        return view(Helper::theme() . 'user.ticket.show')->with($data);
    }


    public function update(TicketRequest $request, $id)
    {

        $isSuccess = $this->ticket->update($request, $id);

        if ($isSuccess['type'] === 'success')
            return redirect()->route('user.ticket.index')->with('success', $isSuccess['message']);
    }


    public function destroy($id)
    {
        $isSuccess = $this->ticket->delete($id);

        if ($isSuccess['type'] === 'success')
            return redirect()->back()->with('success', $isSuccess['message']);
    }

    public function reply(Request $request)
    {
        $isSuccess = $this->ticket->reply($request);

        if ($isSuccess['type'] === 'success')

            return redirect()->back()->with('success', $isSuccess['message']);
    }

    public function statusChange($id)
    {
        $ticket = Ticket::find($id);
        $ticket->status = 1;
        $ticket->save();

        return redirect()->route('user.ticket.index')->with('success', 'Closed conversation Successfully');
    }

    public function ticketStatus(Request $request)
    {
        $ticketStatus = [
            'answered' => 3,
            'pending' => 2,
            'closed' => 1
        ];

        $data['title'] = "{$request->status} Support Ticket";

        $data['tickets'] = Ticket::whereUserId(Auth::user()->id)->whereStatus($ticketStatus[$request->status])->with('ticketReplies')->paginate();

        $data['tickets_pending'] = Ticket::whereUserId(Auth::user()->id)->whereStatus('2')->count();
        $data['tickets_answered'] = Ticket::whereUserId(Auth::user()->id)->whereStatus('3')->count();
        $data['tickets_closed'] = Ticket::whereUserId(Auth::user()->id)->whereStatus('1')->count();
        $data['tickets_all'] = Ticket::whereUserId(Auth::user()->id)->count();
        return view(Helper::theme() . 'user.ticket.list')->with($data);
    }

    public function ticketDownload($id)
    {
        $ticket = TicketReply::findOrFail($id);

        if ($ticket->file) {

            $file = Helper::filePath('Ticket', true) . '/' . $ticket->file;

            if (file_exists($file)) {
                return response()->download($file);
            }
        }
    }
}
