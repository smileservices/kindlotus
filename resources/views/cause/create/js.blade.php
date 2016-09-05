@section('extraJs')
<script type="text/javascript">

  var lat = {{ $location['lat'] }};
  var lng = {{ $location['lon'] }};
  function setCoords(marker){
    var lat = marker.latLng.lat();
    var lng = marker.latLng.lng();
    $('input#lat').val(lat);
    $('input#lng').val(lng);
  };

  function initMap() {
  var myLatLng = {lat: lat, lng: lng};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 9,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Pune-ma unde este cauza',
    draggable: true
  });

  google.maps.event.addListener(marker, 'dragend', function(marker) {
    setCoords(marker);
  });

  };

</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_APP_ID') }}&callback=initMap">
</script>
@endsection