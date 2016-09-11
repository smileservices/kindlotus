@section('extraJs')
<script src="{{url('assets/js/marker-clusterer/src/markerclusterer.js')}}"></script>
<script type="text/javascript">

function initMap() {

    var markers = [];//some array
    var infoWindow = [];

    var map = new google.maps.Map(document.getElementById('map'), {
    });

    <?php $i = 0 ?>
    @foreach ($causes as $cause)
        @if($cause->map)
            var infoWindowContentTitle = '<h5><a href="{{ url('causes/'.$cause->id) }}">{{ $cause->name }}</a></h5>';
            var infoWindowContentTagsCauses = '@include('misc.tagsCause')';
            var infoWindowContentTagsNeeds = '@include('misc.tagsNeed')';
            var infoWindowContentStory = '<p>{{ $cause->description }}</br> <a href="{{ url('causes/'.$cause->id) }}"> vezi mai multe</a></p>';
            var infoWindowContent = infoWindowContentTitle+infoWindowContentTagsCauses+infoWindowContentTagsNeeds+infoWindowContentStory;
            var title = '{{ $cause->name }}';
            markers[{{ $i }}] = new google.maps.Marker({
                position: {
                    lat: {{ $cause->map['coordsX'] }},
                    lng: {{ $cause->map['coordsY'] }}
                },
                map: map,
                title: title
              });
            infoWindow[ {{ $i }} ] = new google.maps.InfoWindow({
            content: infoWindowContent
            });
            markers[{{ $i }}].addListener('click', function() {
            infoWindow[ {{ $i }} ].open(map, markers[{{ $i }}]);
            });
            <?php $i++ ?>
        @endif
    @endforeach
    var clusterImagePath = '{{ url('assets/js/marker-clusterer/images/m') }}';
    var markerCluster = new MarkerClusterer(map, markers, {imagePath: clusterImagePath});


	var bounds = new google.maps.LatLngBounds();
	for (var i = 0; i < markers.length; i++) {
	 if (markers[i]) {
	    bounds.extend(markers[i].getPosition());
	 }
	}

    if (markers.length > 1) {
      map.fitBounds(bounds);
    }
    else if (markers.length == 1) {
      map.setCenter(bounds.getCenter());
      map.setZoom(12);
    }

}
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_APP_ID') }}&callback=initMap">
</script>
@endsection