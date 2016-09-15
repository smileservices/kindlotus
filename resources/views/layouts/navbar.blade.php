@section('navbar')
<!-- Left Side Of Navbar -->
<ul class="nav navbar-nav">
</ul>

<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @if (Auth::guest())
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <i class="fa fa-bars"> </i>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a data-toggle="modal" data-target="#loginModal" href="#">Login ca Voluntar</a></li>
                <li><a href="{{ url('ngo/login') }}">Login ca ONG</a></li>
                <li><a href="{{ url('/register') }}">Inregistreaza-te Voluntar</a></li>
            </ul>
        </li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/home') }}">Home</a></li>
                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
            </ul>
        </li>
    @endif
</ul>
@endsection