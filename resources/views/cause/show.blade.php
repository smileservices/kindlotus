@extends('layouts.app')
@include('cause.meta')
@include('media.css')

@section('content')
<div id="map_container" hidden>
	<div id="map"></div>
</div>

<div class="container mt20">

    @include('search.searchCollapse')
    <!-- social media -->
    @include('layouts.socialShare', ['link' => url('causes/'.$cause->id), 'cause' => $cause])

    {{-- start cause --}}
    <h3>
        <a href="#" data-toggle="tooltip" title="Arata pe harta">
            <i class="fa fa-map-marker" id="show_map" aria-hidden="true"></i>
        </a>
        {{ $cause->name }}<br/>
        <small>in {{ $cause->map->area.', '.$cause->map->city }}</small>
    </h3>

    <p>Adaugat de <a href="{{ url('ngo/'.$cause->ngo['id']) }}">{{ $cause->ngo['name'] }}</a> in data de {{ date('F d, Y', strtotime($cause->created_at)) }}</p>

<div class="row">
<div class="col-sm-12 col-md-6">
    @if(count($videos) > 0)
    <div class="row">
    <div class="col-md-12">
    <div class="embed-responsive embed-responsive-16by9 mt0">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $videos->last()->url }}" frameborder="0" allowfullscreen></iframe>
    </div>
    </div>
    </div>
    @elseif(count($images) > 0)
    <div class="row">
        <div class="col-xs-12">
            <img class="img-responsive" src="{{ url($images->last()->url.$images->last()->name) }}" alt="">
        </div>
    </div>
    @endif
</div>
<div class="col-sm-12 col-md-6">
    <div class="mt20 hidden-md hidden-lg"></div>
    <div class="well">
    <p class="lead">{{ $cause->description }}</p>
    <p>
        Este despre: @include('misc.tagsCause')
    </p>
    <p>
        Poti ajuta cu: @include('misc.tagsNeed')
    </p>
    </div>
@if(count($images))
    @include('media.images', ['images' => $images, 'cause' => $cause])
@endif
</div>
</div>
<div class="row">
<div class="col-md-9">
    <h4>Povestea:</h4>
    <p>{!! nl2br($cause->story) !!}</p>

    {{-- Show contact details--}}
    @if( $canUpdate != null)
        <h4>Datele de contact:</h4>
        <p>{!! nl2br(e($cause->contact)) !!}</p>
    @endif

    @include('cause.show.involveButtonsForms')

{{-- Show Update Form--}}
@if ($canUpdate == 'ngo' || $canUpdate == 'user')
    @include('updates.updatesForm')
@endif

@if(count($updates) > 0)
    <h4>Noutati:</h4>
    <!-- Updates -->
    @include('updates.updates', ['updates' => $updates, 'showCause' => false])
@endif


</div>
<div class="col-md-3">
    @if(count($videos) > 0)
        <h4>Video:</h4>
        @include('media.videos', ['videos' => $videos, 'cause' => $cause])
    @endif
    @if($helpers->count() > 0)
        <h4>Cine ajuta:</h4>
         <ul>
            @foreach ($helpers as $helper)
            <?php $social_account = $helper->socialAccounts()->where('provider', 'facebook')->first(); ?>
            <li>
                @if ($social_account)
                <a target="_blank" href="https://www.facebook.com/{{ $social_account->provider_user_id }}">{{ $helper->name }} </a>
                @else
                <a target="_blank" href="{{ url('user/profile/'.$helper->id) }}">{{ $helper->name }} </a>
                {{ 'on '.date('F d, Y', strtotime($helper->pivot->created_at)) }}
                @endif
            </li>
            @endforeach
         </ul>
     @endif
</div>
</div>
</div>


@include('media.gallery')
@if (Auth::user())
    @include('cause.user.helpModal')
    @if($canUpdate == 'user')
        @include('cause.user.leaveModal')
    @endif
    @if(session('status')=='duplicate')
        @include('cause.user.duplicateModal')
    @elseif(session('status')=='left')
        @include('cause.user.leaveConfirmationModal')
    @endif
@else
    @include('user.loginModal')
@endif

@endsection

@include('cause.show.js')