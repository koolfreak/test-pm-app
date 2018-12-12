<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\IssueTicket;
use App\Models\IssueTicketFile;

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

    public function uploadTicketFIle(Request $request)
    {
        $ticket_id = $request->input('ticket_id'); // use this as directory to house all files uploaded to a ticket
        $ticket = IssueTicket::where('ticket_id', $ticket_id )->first();
        $directory = "tickets/".$ticket_id;
        $file = $request->file('ticketfile');
        $ticketFile = new IssueTicketFile;
        $ticketFile->ticket_id = $ticket->id;
        $ticketFile->filename = $file->getClientOriginalName();
        $ticketFile->file_path = Storage::putFile($directory, $file);

        $ticketFile->save();

        return redirect()->route('admin-ticket-reply',$ticket->id);
    }

    public function downloadTicketFIle($id)
    {
        $file = IssueTicketFile::find($id);
        return Storage::download($file->file_path, $file->filename, []);
    }
}
