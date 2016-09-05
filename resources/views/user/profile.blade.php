@extends('layouts.app')
@section('extraCss')
    @include('media.css')
@endsection

@section('content')
<div class="container">
    <h3>Profilul utilizatorului {{ $user->name }}</h3>
    @if (!$user->active())
        <div class="alert alert-danger">
            Utilizator Inactivat
        </div>
    @endif
    @if (Auth::guard('admin')->check())
        <a href="{{ url('user/ban/'.$user->id) }}"><i class="fa fa-ban"> </i> Toggle Ban</a>
    @else
        {{--<a href="{{ url('user/report/'.$user->id) }}"><i class="fa fa-ban"> </i> Raporteaza utilizatorul</a>--}}
    @endif

    <div class="row">
        <div class="col-sm-12 col-md-8">
        @if (count($user->causes) > 0)
        <h4>Cauzele in care s-a implicat:</h4>
        @foreach ($user->causes as $cause)
            @include('cause.listTemplate', ['cause' => $cause, 'count' => false])
        @endforeach
        @endif
        </div>
        <div class="col-sm-12 col-md-4">
        @if(count($user->updates) > 0)
        <h4>Noutatile postate de utilizator:</h4>
        @include('updates.updates', ['updates' => $user->updates, 'showCause' => true])
        @endif
        </div>
    </div>
</div>
@include('media.gallery')
@endsection

@section('extraJs')
    @include('media.js')
@endsection