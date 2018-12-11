<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Models\IssueTicket;
use App\Models\IssueTicketReply;
use App\Mail\TicketMail;

class Dashboard extends Controller {

    public function index(){

        $tickets = IssueTicket::whereIn('status', [0,1])->get();
        return view('admin.index')->with('tickets', $tickets);
    }

    public function ticketReplies($ticket_id)
    {
        $replies = array();
        $ticket = IssueTicket::find( $ticket_id );
        $ticket_replies = $ticket->replies;

        return view('admin.reply_ticket')->with('ticket', $ticket)->with('replies', $ticket_replies); // replies here
    }

    public function addReply(Request $request)
    {
        $ticket_id = $request->input('ticket_id');
        $reply = new IssueTicketReply;
        $reply->ticket_id = $ticket_id;
        $reply->user_id = session()->get('user_id');
        $reply->message = $request->input('message');
        $reply->rating = 0;
        $reply->save();

        // update the status of ticket once there is a reply from admin
        $ticket = IssueTicket::find($ticket_id);
        if( $ticket->status == 0 ){
            $ticket->status = 1;
            $ticket->save();
        }

        // send email to customer for a reply to the ticket
        $data = array();
        $data['type'] = 'reply';
        $data['ticket_id'] = $ticket->ticket_id;
        $data['subject'] = "Reply to ticket # ".$ticket->ticket_id;
        $data['from'] = 'admin@pm.com';
        $data['reply_message'] =$request->input('message');
        $data['to_name'] = $ticket->user->name;

        Mail::to( $ticket->user->email )->send(new TicketMail($data));

        return response()->json(['success'=>true]);
    }

    public function closeTicket($ticket_id)
    {
        $ticket = IssueTicket::find( $ticket_id );
        $ticket->status = 2;
        $ticket->save();

        // send email for closed ticket
        $data = array();
        $data['type'] = 'close';
        $data['ticket_id'] = $ticket->ticket_id;
        $data['subject'] = "Closed ticket # ".$ticket->ticket_id;
        $user = $ticket->user;
        $user['to_name'] = $user->name;
        $user['from'] = 'admin@pm.com';
        
        Mail::to($user->user->email)->send(new TicketMail($data));

        return redirect()->route('admin-main');
    }

}