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

    public function index()
    {
        
    }

    public function createTicket(Request $request)
    {
        $user = Auth::user();

        $ticket = new IssueTicket;
        $ticket->user_id = $user->id;
        $ticket->title = $request->input('title');
        $ticket->description = $request->input('title');
        $ticket_id = $this->getToken(5).'-'.$this->getToken(5).'-'.$this->getToken(5).'-'.$this->getToken(8);
        $ticket->ticket_id = $ticket_id;
        $ticket->save();

        // TODO send email to customer

        return response()->json(['success'=>true]);
    }

    public function ticketList()
    {
        $tickets = IssueTicket::all();
        
    }

    public function ticketReplies($ticket_id)
    {
        $replies = array();
        $ticket = IssueTicket::find( $ticket_id );
        $ticket_replies = $ticket->replies;

        foreach ($ticket_replies as $reply ) {
            array_push($replies, $reply);
        }

        return []; // replies here
    }

    private function getToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); 

       for ($i=0; $i < $length; $i++) {
           $token .= $codeAlphabet[random_int(0, $max-1)];
       }
   
       return $token;
   }
}