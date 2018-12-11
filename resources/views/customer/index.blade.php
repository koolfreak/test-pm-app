@extends('layout.default')

@section('main_content')
<div class="row">

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
                            In Progress
                         @endif
                    </td>
                     <td>
                         <a href="">View Reply</a>
                     </td>
                 </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection