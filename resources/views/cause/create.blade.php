@extends('layouts.app')

@section('content')

<div class="container">

<h3>Cauza noua</h3>



  <div class="panel panel-default">
    <div class="panel-body">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

      <form action="{{ url('causes') }}" method="POST">
        <div class="form-group">
          <label for="">Numele Cauzei</label>
          <input class="form-control" type="text" name="name">
        </div>

        <div class="form-group">
          <label for="">Scurta descriere (255 caractere)</label>
          <textarea class="form-control" name="description" id="" cols="30" rows="3"></textarea>
        </div>

        <div class="form-group">
          <label for="">Povestea</label>
          <textarea class="form-control" name="story" id="" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group" id="causes">
          <label class="control-label" for="tags">Tipul cauzei</label>
          <select class="form-control" name="tags[]" multiple="multiple">
            @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group" id="needs">
          <label class="control-label" for="needs">Cu ce putem ajuta</label>
          <select class="form-control" name="needs[]" multiple="multiple">
            @foreach($needs as $tag)
            <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="">Datele de contact pentru voluntari</label>
          <textarea class="form-control" name="contact" id="" cols="30" rows="3"></textarea>
        </div>

        <div class="form-group">
          <label for="">Seteaza pozitia pe harta</label>
          <div id="map_container">
            <div id="map"></div>
          </div>
        </div>

        <input type="hidden" id="lat" name="lat">
        <input type="hidden" id="lng" name="lng">


        <button id="" class="btn btn-primary btn-block" type="submit">
          Trimite
        </button>

    </div>
  </div>

</div>

@endsection

@include('cause.create.js')