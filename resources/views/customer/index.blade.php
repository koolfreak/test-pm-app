@extends('layout.default')

@section('main_content')
<div class="row">

    <div class="col s12 m6">
        <h3>My Tickets</h3>
    </div>
    <div class="col s12 m6">
        <a href="{{ route('customer-ticket-add') }}" class="waves-effect waves-light btn-large">Create Ticket</a>
    </div>
    <div class="col s12">
        <table>
            <thead>
                <th>Ticket ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Status</th>
                <th>View Reply</th>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                 <tr>
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
                         @if( $ticket->status == 2 )
                            Closed
                         @endif
                    </td>
                     <td>
                         <a href="{{ route('customer-ticket-replies',$ticket->id) }}">View</a>&nbsp;|&nbsp;
                         <a href="{{ route('customer-ticket-close',$ticket->id) }}">Close</a>
                     </td>
                 </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection