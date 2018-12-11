<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if( $this->data['type'] == 'create'){
            return $this->subject($this->data['subject'])
                    ->from($this->data['from'])
                    ->view('mail.create_ticket');
        }
        if( $this->data['type'] == 'reply'){
            return $this->subject($this->data['subject'])
                    ->from($this->data['from'])
                    ->view('mail.reply_ticket');
        }
        if( $this->data['type'] == 'close'){
            return $this->subject($this->data['subject'])
                    ->from($this->data['from'])
                    ->view('mail.closed_ticket')->with('data', $this->data);
        }
        return $this->view('view.name');
    }
}
