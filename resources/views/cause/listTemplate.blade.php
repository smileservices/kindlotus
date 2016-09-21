<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2 col-xs-12">
                <a href="{{ url('causes/'.$cause->id) }}">
                    <img class="img-responsive" src="{{ $cause->primaryImageThumb() }}" alt="{{ $cause->name }} primary photo"/>
                </a>
            </div>
            <div class="col-sm-10 col-xs-12">
                <h4><a href="{{ url('causes/'.$cause->id) }}">{{ ($count ? $count.'# ' : '') }}{{ $cause->name }}</a> <small>in {{ $cause->map->area.', '.$cause->map->city }}</small></h4>
                <p>
                    {{ $cause->description }}
                    <a href="{{ url('causes/'.$cause->id) }}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> </a>
                </p>
                <span class="tags-container">@include('misc.tagsCause') @include('misc.tagsNeed')</span>
            </div>
        </div>
    </div>
</div>