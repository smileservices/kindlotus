@section('navbar')
<!-- Left Side Of Navbar -->
<ul class="nav navbar-nav">
    <li><a href="{{ url('/admin') }}">Admin Dashboard</a></li>
</ul>

<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('admin/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
            </ul>
        </li>

</ul>
@overwrite