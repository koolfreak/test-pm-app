Hi {{ $data['to_name'] }},<br/>

<p>
There is a reply from your ticket #{{ $data['ticket_id'] }}, <a href="{{ route('public-view-ticket', $data['ticket_id']) }}">Click here</a>.
</p>
Comment:
<p>{{ $data['reply_message'] }}</p>
<br/>
Thanks,<br/>
PM Systen CS