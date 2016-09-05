@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Admin Section</h3>
    <ul class="list-unstyled">
        <li><a href="{{ url('ngo/register') }}"><i class="fa fa-plus-square"> </i> NGO nou</a></li>
        <li><a href="{{ url('admin/tags') }}"><i class="fa fa-edit"> </i> Editeaza Taguri</a></li>
    </ul>
    <h4>Cauzele Pending:</h4>
        @foreach($causesPending as $cause)
        <?php $class="text-info"; ?>
        <p class="{{ $class }}">
            <a href="{{ url('causes/'.$cause->id.'/edit') }}"><i class="fa fa-edit"></i></a>
            | <span><a href="{{ url('causes/'.$cause->id) }}" class={{ $class }}>{{ $cause->name }}</a></span>
            | 3 iulie, 2016
            | <i class="fa fa-user-times"> </i> {{ count($cause->users) }}
        </p>
        @endforeach

    <h4>Cauzele Inactive:</h4>
        @foreach($causesInactive as $cause)
        <?php $class="text-danger"; ?>
        <p class="{{ $class }}">
            <a href="{{ url('causes/'.$cause->id.'/edit') }}"><i class="fa fa-edit"></i></a>
            | <span><a href="{{ url('causes/'.$cause->id) }}" class={{ $class }}>{{ $cause->name }}</a></span>
            | 3 iulie, 2016
            | <i class="fa fa-user-times"> </i> {{ count($cause->users) }}
        </p>
        @endforeach

</div>



@endsection

