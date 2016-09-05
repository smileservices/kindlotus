@extends('layouts.app')

@section('content')

    <div class="container mt20">
        <h2>ONG-urile active: </h2>
        <ul class="list-unstyled">
        @foreach($ngos as $key => $ngo)
            <li>
                <a href="{{ url('ngo/profile/'.$ngo->id) }}">{{ $ngo->name }}</a>
            </li>
        @endforeach
        </ul>

    </div>
@endsection