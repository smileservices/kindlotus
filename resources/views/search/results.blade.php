@extends('layouts.app')

@section('content')

@if (count($causes) != 0)
<div id="map_container">
    <div id="map"></div>
</div>
@endif
<div class="container mt20">
    @include('search.searchCollapse')
    <!-- causes -->
@if (count($causes) > 0 )
<?php $count = 0; ?>
    @foreach($causes as $key => $cause)
        <?php $count++; ?>
        @include('cause.listTemplate', ['$cause' => $cause, 'count' => $count])
    @endforeach
@else
    <h3>Nu exista cauze care sa corespunda cautarii</h3>
@endif
@endsection
</div>
@if (count($causes) != 0)
@include('search.js')
@endif