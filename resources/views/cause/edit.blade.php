@extends('layouts.app')
@include('media.css')

@section('content')
<div class="container">

 <h3>Editeaza Cauza <small><a href="{{ url('causes/'.$cause->id) }}">vezi cauza <i class="fa fa-eye"> </i></a></small></h3>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('cause.edit.text')
    @include('cause.edit.media')
    @include('cause.edit.buttons')
    @include('media.gallery')

</div>
@endsection

@include('cause.edit.js')