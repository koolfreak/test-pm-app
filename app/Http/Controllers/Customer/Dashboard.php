<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;
use App\Models\IssueTicket;
use App\Models\IssueTicketReply;
use App\Mail\TicketMail;

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

        // send email to customer for newly created ticket
        $data = array();
        $data['type'] = 'create';
        $data['ticket_id'] = $ticket_id;
        $data['subject'] = "New ticket # ".$ticket_id;
        $user = $ticket->user;
        $data['from'] = $user->email;
        $data['from_name'] = $user->name;

        Mail::to('admin@pmsystem.com')->send(new TicketMail($data));

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

    public function addReply(Request $request)
    {
        $reply = new IssueTicketReply;
        $reply->ticket_id = $request->input('ticket_id');
        $reply->user_id = session()->get('user_id');
        $reply->message = $request->input('message');
        $reply->rating = 0;
        $reply->save();

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