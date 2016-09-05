@if(count($medias) > 0)
    <?php $video = ['youtube' => array()]; ?>
    <div class="row">
        <div class="col-xs-12">
        <div id="links">
            <ul class="list-inline">
    @foreach($medias as $media)
        @if ($media['type'] == 'image')
        <li>
            <a href="{{ url($media['url']).'/'.$media['name'] }}" data-gallery>
                <img class="edit_photo" src="{{ url($media['url']).'/'.'thumb_'.$media['name'] }}">
            </a>
            @if (Auth::guard('admin')->check() && isset($isUpdate))
                <br/>
                <a href="{{ url('updates/'.$cause->id.'/media/'.$media['id'].'/remove') }}"><i class="fa fa-trash-o "> </i> delete</a>
            @endif
        </li>
        @elseif ($media['type'] == 'youtube')
        <?php array_push($video['youtube'], $media); ?>
        @endif
    @endforeach
            </ul>
        </div>
        </div>
    </div>
@endif

<!-- Video -->
@if (isset($video['youtube']))
<div class="row">
    @foreach($video['youtube'] as $youtube)
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
@endif