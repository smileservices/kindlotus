<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <h4><a href="{{ url('causes/'.$cause->id) }}">{{ ($count ? $count.'# ' : '') }}{{ $cause->name }}</a></h4>
                <span class="tags-container">@include('misc.tagsCause') @include('misc.tagsNeed')</span>
            </div>
            <div class="col-md-12">
                <p>
                    {{ $cause->description }}
                    <a href="{{ url('causes/'.$cause->id) }}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> </a>
                </p>
            </div>
        </div>
    </div>
</div>