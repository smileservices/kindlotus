@if(count($cause->media) > 0)
    <?php $video = ['youtube' => array()]; ?>
    <div class="row">
     <div class="col-xs-12">
        <h3>Foto/Video:</h3>
            <div id="links">
            <ul class="list-inline">
    @foreach($cause->media as $media)

        @if ($media['type'] == 'image')
        <li>
        <a href="{{ url($media['url']).'/'.$media['name'] }}" data-gallery>
            <img class="edit_photo" src="{{ url($media['url']).'/'.'thumb_'.$media['name'] }}">
        </a><br/>
        <a href="{{ url('causes/'.$cause->id.'/delete/media/'.$media['id']) }}"><i class="fa fa-trash-o"> </i> delete</a>
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
  <div class="row mt20">
    <div class="col-xs-12 col-sm-6 col-md-4">
        @foreach($video['youtube'] as $youtube)
        <div class="thumbnail">
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $youtube['url'] }}" frameborder="0" allowfullscreen></iframe>
          </div>
          <span class="help-block text-right"><a href="{{ url('causes/'.$cause->id.'/delete/media/'.$media['id']) }}"><i class="fa fa-trash-o"> </i> Delete Movie</a></span>
        </div>
        @endforeach
    </div>
  </div>
@endif


  <div class="panel panel-default">
    <div class="panel-body">

      <form enctype="multipart/form-data" method="POST" action="{{ url('causes/'.$cause->id) }}">
        <div class="form-group">
            <label for="images">Incarca Imagini</label>
            <input class="form-control" type="file" id="images" name="images[]" multiple>
        </div>
        <div class="form-group">
            <label for="images">Incarca Video de pe youtube</label>
            <input class="form-control" type="text" id="video" name="video">
        </div>
        <input type="hidden" name="_method" value="PATCH"/>
        {{ csrf_field() }}
        <button id="" class="btn btn-primary btn-block" name="submit" value="media_upload">
              Incarca Foto/Video
        </button>
      </form>

    </div>
  </div>