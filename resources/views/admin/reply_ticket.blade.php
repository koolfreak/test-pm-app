@extends('layout.default')

@section('main_content')
<div class="row">
        <div class="row">
            <div class="col s12">
                <label style="display: inline;">From:</label>
                <span>{{ $ticket->user->name }}</span>
            </div>
            <div class="col s12">
                <label style="display: inline;">Title:</label>
                <span>{{ $ticket->title }}</span>
            </div>
            <div class="col s12">
                <label>Description:</label>
                <p>{{ $ticket->description }}</p>
            </div>
            <input type="hidden" id="ticket_id" value="{{ $ticket->id }}" />
        </div>
        <div class="row">
            <hr/>
            <h5>Comments</h5>
            <table id="table_comments">
                <tbody>
                    @foreach($replies as $reply)
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col s2">
                                    <label style="display: inline;">From:</label>
                                    <span>{{ $reply->user->name }}</span>
                                </div>
                                <div class="col s6">
                                    <span>{{ $reply->created_at }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <p>{{ $reply->message }}</p>
                                </div>
                            </div>
                            @if( $reply->rating > 0 )
                            <p><b>{{ $reply->rating }}</b> stars</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="ticketReply" name="ticketReply" class="materialize-textarea"></textarea>
                        <label for="ticketReply">Reply</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="button" id="sendReply">Reply
                    <i class="material-icons left">reply</i>
                </button>
                <a href="{{ route('admin-main') }}" class="waves-effect waves-light btn-small">Cancel</a>
        </div>

</div>
@endsection 
@section('javascript')  
<script type="text/javascript">
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': "{!! csrf_token() !!}"
            }
        });

        $('#sendReply').click(function(){

            var params = {
                'ticket_id': $('#ticket_id').val(),
                'message': $('#ticketReply').val()
            }

            $.post("{{ route('admin-ticket-add-reply') }}", params, function(result){
                alert('Success');
                location.reload();
            });

        });

    });
</script>
@endsection