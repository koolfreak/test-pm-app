<?php

namespace App\Http\Controllers\Customer;

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
        $tickets = IssueTicket::where('user_id', session()->get('user_id'))->get();

        return view('customer.index')->with('tickets', $tickets);
    }

    public function createTicket(Request $request)
    {
        $ticket = new IssueTicket;
        $ticket->user_id = session()->get('user_id');
        $ticket->title = $request->input('title');
        $ticket->description = $request->input('description');
        $ticket_id = $this->getToken(5).'-'.$this->getToken(5).'-'.$this->getToken(5).'-'.$this->getToken(8);
        $ticket->ticket_id = $ticket_id;
        $ticket->save();

        // TODO send email to customer

        return redirect()->route('customer-main');
    }

    public function addTicket()
    {
        return view('customer.add_ticket');
    }

    public function ticketReplies($ticket_id)
    {
        $replies = array();
        $ticket = IssueTicket::find( $ticket_id );
        $ticket_replies = $ticket->replies;

        return view('customer.show_ticket')->with('ticket', $ticket)->with('replies', $ticket_replies); // replies here
    }

    public function rateReply(Request $request)
    {
        $ticket = IssueTicketReply::find( $request->input('reply_id') );
        $ticket->rating = $request->input('star');
        $ticket->save();

        return response()->json(['success'=>true]);
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