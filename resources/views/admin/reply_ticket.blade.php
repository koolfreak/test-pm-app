@extends('layout.default')

@section('main_content')
<div class="row">
        <div class="row">
            <div class="col s12">
                <label style="display: inline;">From:</label>
                <span>Hello World</span>
            </div>
            <div class="col s12">
                <label style="display: inline;">Title:</label>
                <span>Hello World</span>
            </div>
            <div class="col s12">
                <label>Description:</label>
                <p>Hello World</p>
            </div>
        </div>
        <div class="row">
            
                
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="ticketReply" name="ticketReply" class="materialize-textarea"></textarea>
                        <label for="description">Reply</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="button" id="sendReply">Reply
                    <i class="material-icons left">reply</i>
                </button>
            
        </div>

</div>
@endsection 
@section('javascript')  
<script type="text/javascript">
    $(document).ready(function(){

        

    });
</script>
@endsection