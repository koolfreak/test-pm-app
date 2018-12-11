@extends('layout.default')

@section('main_content')
<div class="row">

        <div class="row">
            <form class="col s12" action="{{ route('customer-ticket-store') }}" method="POST">
                {{ csrf_field() }}
                <h3>Create Ticket</h3>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="title" name="title" type="text" />
                        <label for="title">Ticket Title</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="description" name="description" class="materialize-textarea"></textarea>
                        <label for="description">Ticket Details</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Create
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>

</div>
@endsection    