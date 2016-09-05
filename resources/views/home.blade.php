@extends('layouts.app')




@section('content')
<div class="container">

    <h3>Cauzele In care te-ai implicat:</h3>
    @foreach($lastCauses as $cause)
        @include('cause.listTemplate', ['cause' => $cause])
    @endforeach

</div>
@endsection
