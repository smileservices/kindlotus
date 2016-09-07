@section('extraJs')
@include('media.js')
@include('cause.setAddressJS')
<script>

function initMap() {

  var myLatLng = {
    lat: {{ $cause->map['coordsX'] }},
    lng:{{ $cause->map['coordsY'] }}
  };

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

  var geocoder = new google.maps.Geocoder;

  google.maps.event.addListener(marker, 'dragend', function(marker) {
    var latLng = setCoords(marker);
    geocoder.geocode({'location': latLng}, function(results, status) {
        setAddress(results);
      });
  });

   $('#editDetailsButton').click(function(){
      setTimeout(function(){
        initMap();
      }, 50);
    })
 }

</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_APP_ID') }}&callback=initMap">
</script>
@endsection