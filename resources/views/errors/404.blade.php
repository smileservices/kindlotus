@extends('layouts.app')

@section('content')

<div class="container mt20">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                   Ne pare rau, pagina nu a fost gasita!
                </div>
                <div class="error-actions">
                    <a href="{{ url('/') }}" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span>
                        Inapoi </a><a href="{{ url('/contact') }}" class="btn btn-default"><span class="glyphicon glyphicon-envelope"></span> Trimite un mesaj </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection