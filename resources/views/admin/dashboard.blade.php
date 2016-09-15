@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h3>Admin Section</h3>
        <ul class="list-unstyled">
            <li><a href="{{ url('ngo/register') }}"><i class="fa fa-plus-square"> </i> NGO nou</a></li>
            <li><a href="{{ url('admin/tags') }}"><i class="fa fa-edit"> </i> Editeaza Taguri</a></li>
        </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h4>Cauzele Active:</h4>
            @foreach($causesActive as $cause)
               @include('cause.link', ['class' => 'text-success'])
            @endforeach
        </div>
        <div class="col-md-4">
            <h4>Cauzele Pending:</h4>
            @foreach($causesPending as $cause)
               @include('cause.link', ['class' => 'text-attention'])
            @endforeach
        </div>
        <div class="col-md-4">
            <h4>Cauzele Inactive:</h4>
            @foreach($causesInactive as $cause)
            <?php $class="text-danger"; ?>
               @include('cause.link', ['class' => 'text-danger'])
            @endforeach
       </div>
    </div>
</div>



@endsection

