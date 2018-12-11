<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Models\IssueTicket;
use App\Models\IssueTicketReply;

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

}