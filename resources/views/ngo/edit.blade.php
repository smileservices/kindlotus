@extends('layouts.app')

@section('content')

<div class="container mt20">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Editeaza Profilul Organizatiei</h4>
        </div>
        <div class="panel-body">
            <form action="{{ url('ngo/patch') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PATCH"/>

                <div class="form-group">
                    <label for="name">Numele Organizatiei</label>
                    <input class="form-control" type="text" name="name" value="{{ $ngo->name }}"/>
                </div>

                <div class="form-group">
                    <label for="about">Despre</label>
                    <textarea class="form-control" name="about" id="about" cols="30" rows="4" placeholder="Cateva randuri despre organizatie">{{ $ngo->about }}</textarea>
                </div>

                <div class="form-group">
                    <label for="contact">Date de contact</label>
                    <textarea class="form-control" name="contact" id="contact" cols="30" rows="3" placeholder="Datele de contact">{{ $ngo->contact }}</textarea>
                </div>

                <div class="form-group">
                    <label for="website">Weblink</label>
                    <input class="form-control" type="text" name="website" value="{{ $ngo->website }}" placeholder="Site-ul organizatiei"/>
                </div>

                <button class="btn btn-primary btn-block" type="submit">Trimite</button>

            </form>
        </div>
    </div>
</div>

@endsection