@extends('layouts.app')

@section('content')

<div class="container">

	<h3>Cauzele proprii:</h3>
    <p><a href="{{url('causes/create')}}"><i class="fa fa-plus-square"> </i> Cauza Noua</a></p>
	    @foreach($causes as $cause)
	    <?php
        if ($cause->isApproved()) {
            $class="text-success";
        } elseif($cause->activePending()) {
            $class="text-info";
        } else {
            $class="text-danger";
        } ?>
        <p class="{{ $class }}">
			<a href="{{ url('causes/'.$cause->id.'/edit') }}"><i class="fa fa-edit"></i></a>
			| <span><a href="{{ url('causes/'.$cause->id) }}" class={{ $class }}>{{ $cause->name }}</a></span>
			| 3 iulie, 2016
			| <i class="fa fa-user-times"> </i> {{ count($cause->users) }}
		</p>
	    @endforeach

</div>



@endsection

