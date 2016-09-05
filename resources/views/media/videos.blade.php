<div class="row">
    @foreach($videos as $youtube)
        <div class="col-md-12">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $youtube->url }}" frameborder="0" allowfullscreen></iframe>
        </div>
        @if (Auth::guard('admin')->check() && isset($isUpdate))
            <br/>
            <a href="{{ url('updates/'.$cause->id.'/media/'.$youtube->id.'/remove') }}"><i class="fa fa-trash-o "> </i> delete</a>
        @endif
        </div>
    @endforeach
</div>