@extends('layouts.app')

@section('content')
<div class="container mt20">
    <h2>Profilul "{{ $ngo->name }}"</h2>
<div class="row">
    <div class="col-sm-12">
        <h4>Despre</h4>
        <p>{!! nl2br(e($ngo->about)) !!}</p>
        <h4>Contact</h4>
        <p><a href="{{ $ngo->website }}">{{ $ngo->website }}</a></p>
        <p>{!! nl2br(e($ngo->contact)) !!}</p>
    </div>
    <div class="col-sm-12 col-md-6">
        <h4>Cauzele active:</h4>
        @foreach($causes->where('active', 2) as $key => $cause)
            @include('cause.listTemplate', ['cause' => $cause, 'count' => false])
        @endforeach

        @if (Auth::guard('admin')->check())
        <h4>Pending:</h4>
        @foreach($causes->where('active', 1) as $key => $cause)
            @include('cause.listTemplate', ['cause' => $cause, 'count' => false])
        @endforeach
        <h4>Inactive:</h4>
        @foreach($causes->where('active', 0) as $key => $cause)
            @include('cause.listTemplate', ['cause' => $cause, 'count' => false])
        @endforeach
        @endif
    </div>
    <div class="col-sm-12 col-md-6">
        @if (count($ngo->updates) > 0)
            <h4>Noutati Postate:</h4>
            @include('updates.updates', ['updates' => $ngo->updates, 'showCause' => true])
        @endif
    </div>
</div>
</div>
@endsection