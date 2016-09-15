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
           @include('cause.link', ['class' => $class])
	    @endforeach

</div>



@endsection

