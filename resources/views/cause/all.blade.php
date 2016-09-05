@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Causes:</h1>
    <ul>
        @foreach($causes as $cause)
        <li>
            <a href="{{ url('causes/'.$cause->id) }}">{{ $cause->name }}</a>
        </li>
        @endforeach
    </ul>
</div>
@endsection