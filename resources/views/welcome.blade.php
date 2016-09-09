@extends('layouts.app')
@include('media.css')

@section('content')
@include('misc.header')


<div class="container">
    @include('search.search')
    <div class="row">
    <div class="col-sm-12 col-md-8">
    <h3>Ultimele cauze adaugate:</h3>
    <?php $count = 0 ?>
    @foreach($lastCauses as $cause)
        @include('cause.listTemplate', ['cause' => $cause, 'count' => $count])
    @endforeach
    </div>
    <div class="col-sm-12 col-md-4">
    <h3>Ultimele noutati adaugate:</h3>
    @include('updates.updates', ['updates' => $lastUpdates, 'showCause' => true])
    </div>
    </div>
</div>
@include('media.gallery')

@endsection

@section('extraJs')
    @include('media.js')
@endsection

