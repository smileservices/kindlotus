@extends('emails.mailTemplate')
@section('content')

    <p>
        <strong>{{ $data['name'] }}</strong> writes:
    </p>
    <p>
        " {{ $data['message'] }} "
    </p>
    <p>
        Can be contacted at <strong>{{ $data['email'] }}</strong>
    </p>

@endsection