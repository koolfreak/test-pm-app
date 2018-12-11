<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueTicket extends Model
{
    //
    public function replies()
    {
        return $this->hasMany('App\Models\IssueTicketReply', 'ticket_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
