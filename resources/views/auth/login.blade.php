@extends('layouts.app')

@section('content')
<div class="container mt20">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">


                <a href="{{ route('social.login', ['facebook']) }}" class="btn btn-block btn-social btn-facebook">
                    <span class="fa fa-facebook"></span> Conecteaza-te cu Facebook (recomandat)
                </a>
                <a href="{{ route('social.login', ['google']) }}" class="btn btn-block btn-social btn-google">
                    <span class="fa fa-google"></span> Conecteaza-te cu Google
                </a>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <hr>
                        <h5 class="text-center">sau conecteaza-te in modul clasic</h5>
                    </div>
                </div>

		<div class="row">
            <form class="" action="{{ url('/login') }}" autocomplete="off" method="POST">
                <div class="col-sm-12 col-md-6">
                <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail">
                </div>
                <span class="help-block">
                @if ($errors->has('email'))
                    <strong>{{ $errors->first('email') }}</strong>
                @endif
                </span>
                </div>
                <div class="col-sm-12 col-md-6">
                <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input  type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <span class="help-block">
                @if ($errors->has('password'))
                        <strong>{{ $errors->first('password') }}</strong>
                @endif
                </span>
                </div>
                {{ csrf_field() }}
                <div class="col-xs-12">
                <button class="btn btn-primary btn-block" type="submit">Login</button>
                <span class="help-block"><a href="{{ url('/password/reset') }}">Am uitat parola</a> | <a href="{{ url('register') }}">Inregistrare</a></span>
                </div>
            </form>
    	</div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
