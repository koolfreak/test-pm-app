<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\IssueTicket;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function viewTicket($ticket_id=null)
    {
        $replies = array();
        $ticket = IssueTicket::where('ticket_id', $ticket_id )->first();
        $ticket_replies = $ticket->replies;

        return view('main.view_ticket')->with('ticket', $ticket)->with('replies', $ticket_replies); // replies here
    }
}
