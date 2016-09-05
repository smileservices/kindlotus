@section('meta')
<title>{{ $cause->name }}</title>
<meta property="fb:app_id" content="{{ env('FACEBOOK_APP_ID') }}" />
<meta property="og:site_name" content="{{ env('SITE_NAME') }}" />
<meta property="og:title" content="{{ $cause->name }}" />
<meta property="og:description" content="{{ $cause->description }}" />
<meta property="og:type" content="place" />
<meta property="place:location:latitude"  content="{{ $cause->map->coordsX }}" />
<meta property="place:location:longitude" content="{{ $cause->map->coordsY }}" />
<meta property="og:url" content="{{ url('causes/'.$cause->id) }}" />
@if (count($images) > 0)
<meta property="og:image" content="{{ url($images->last()->url.$images->last()->name) }}" />
@endif
@endsection