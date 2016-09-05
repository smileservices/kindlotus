@if(Auth::guard('admin')->check())
<a href="{{ url('updates/'.$update->id.'/active') }}" data-toggle="tooltip" title="Arata"><i class="fa fa-eye pull-right"></i></a>
@endif