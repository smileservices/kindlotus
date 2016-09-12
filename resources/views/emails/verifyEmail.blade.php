@extends('emails.mailTemplate')
@section('content')

    <p>
        Thank you for registering, {{ $name }}!
    </p>
    <p>
        Please verify this e-mail address by clicking on this link: <br/>
        <a href="{{ url('user/register/verify/'.$code) }}">Click Aici pentru a valida aceasta adresa</a>
    </p>

@endsection