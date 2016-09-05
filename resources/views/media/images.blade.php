<div class="row">
    <div class="col-xs-12">
    <div id="links">
        <ul class="list-inline">
        @foreach ($images as $image)
            <li>
                <a href="{{ url($image['url']).'/'.$image['name'] }}" data-gallery>
                    <img class="edit_photo" src="{{ url($image['url']).'/'.'thumb_'.$image['name'] }}">
                </a>
                @if (Auth::guard('admin')->check() && isset($isUpdate))
                    <br/>
                    <a href="{{ url('updates/'.$cause->id.'/media/'.$image['id'].'/remove') }}"><i class="fa fa-trash-o "> </i> delete</a>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
    </div>
</div>
