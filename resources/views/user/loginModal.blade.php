<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="loginLabel">Intra in cont sau inregistreaza-te</h4>
      </div>
      <div class="modal-body">

		<a href="{{ route('social.login', ['facebook']) }}" class="btn btn-block btn-social btn-facebook">
            <span class="fa fa-facebook"></span> Conecteaza-te cu Facebook (recomandat)
        </a>
        <a href="{{ route('social.login', ['google']) }}" class="btn btn-block btn-social btn-google">
            <span class="fa fa-google"></span> Conecteaza-te cu Google
        </a>

        <div class="row">
			<div class="col-xs-12">
				<hr>
				<h5 class="text-center">sau conecteaza-te in modul clasic</h5>
			</div>
		</div>

		<div class="row">
            <form class="" action="{{ url('/login') }}" autocomplete="off" method="POST">
                <div class="col-sm-12 col-md-6">
                <div class="input-group{{ $errors->userLogin->has('email') ? ' has-error' : '' }}">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail">
                </div>
                <span class="help-block">
                @if ($errors->userLogin->has('email'))
                    <strong>{{ $errors->userLogin->first('email') }}</strong>
                @endif
                </span>
                </div>
                <div class="col-sm-12 col-md-6">
                <div class="input-group{{ $errors->userLogin->has('email') ? ' has-error' : '' }}">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input  type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <span class="help-block">
                @if ($errors->userLogin->has('password'))
                        <strong>{{ $errors->userLogin->first('password') }}</strong>
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