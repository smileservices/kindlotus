{{--<a href="{{ url('updates/'.$update->id.'/report') }}" data-toggle="tooltip" title="Marcheaza ca nepotrivit"><i class="fa fa-flag-o pull-right"></i></a>--}}
@if(Auth::guard('admin')->check())
<a href="{{ url('updates/'.$update->id.'/active') }}" data-toggle="tooltip" title="Ascunde"><i class="fa fa-eye-slash pull-right"></i></a>
@endif

