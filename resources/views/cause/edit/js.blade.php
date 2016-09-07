@section('extraJs')
@include('media.js')

<script>
function setCoords(marker) {
    var lat = marker.latLng.lat();
    var lng = marker.latLng.lng();
    var latLng = {
        lat: lat,
        lng: lng
    };
    $('input#lat').val(lat);
    $('input#lng').val(lng);
    return latLng;
  }
function setAddress(results) {
    var address_components = results[1].address_components;
    var country = results[results.length-1].formatted_address;
    var area = results[results.length-2].address_components[0].short_name;
    var city = results[results.length-3].address_components[0].short_name;
    var size = address_components.length;
    var address = {
        country: country,
        area: area,
        city: city
    };
    $('input#country').val(address.country);
    $('input#area').val(address.area);
    $('input#city').val(address.city);
  }

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