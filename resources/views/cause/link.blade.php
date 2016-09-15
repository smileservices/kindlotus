<p class="{{ $class }}">
    <a href="{{ url('causes/'.$cause->id) }}"><i class="fa fa-eye"></i></a>
    | <span><a href="{{ url('causes/'.$cause->id.'/edit') }}" class={{ $class }}>{{ $cause->name }}</a></span>
    | <i class="fa fa-edit"></i> on {{ date('F d, Y', strtotime($cause->updated_at)) }}
    | <i class="fa fa-user-times"> </i> {{ count($cause->users) }}
</p>