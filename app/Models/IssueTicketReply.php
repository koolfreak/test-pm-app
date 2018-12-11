<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueTicketReply extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
