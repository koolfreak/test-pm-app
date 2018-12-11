@extends('layout.default')

@section('main_content')
<div class="row">

    <div class="col s12 m6">
        <h3>Open Tickets</h3>
    </div>
    <div class="col s12">
        <table>
            <thead>
                <th>Customer</th>
                <th>Ticket ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Status</th>
                <th>Reply</th>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                 <tr>
                     <td>{{ $ticket->user->name }}</td>
                     <td>{{ $ticket->ticket_id }}</td>
                     <td>{{ $ticket->title }}</td>
                     <td>{{ $ticket->created_at }}</td>
                     <td>
                         @if( $ticket->status == 0 )
                            Opened
                         @endif
                         @if( $ticket->status == 1 )
                            In Progress
                         @endif
                         
                    </td>
                     <td>
                         <a href="{{ route('admin-ticket-reply', $ticket->id) }}">Reply</a>&nbsp;|&nbsp;
                         <a href="{{ route('admin-ticket-close',$ticket->id) }}">Close</a>
                     </td>
                 </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection