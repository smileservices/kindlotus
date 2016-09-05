@if( $cause->success == 0 )
    @if( $canUpdate == 'user' )
        {{--Invovled User--}}
        @include('cause.involved.userEdit')
    @elseif( $canUpdate == 'ngo' )
        {{--Owner NGO--}}
        @include('cause.involved.ngoEdit')
    @else
        @if (Auth::user())
        {{--Uninvolved User--}}
        <form action="{{ url('causes/'.$cause->id.'/help') }}" method="GET">
            <button class="btn btn-primary btn-block">Vreau sa ajut</button>
            {{ csrf_field() }}
        </form>
        @else
        {{--Guest--}}
        <form action="{{ url('causes/'.$cause->id.'/help') }}" method="GET">
            <button class="btn btn-primary btn-block">Vreau sa ajut</button>
            {{ csrf_field() }}
        </form>
        @endif
    @endif
@else
<div class="alert alert-success">
    Scopul campaniei a fost indeplinit!
</div>
@endif