@section('extraJs')
@include('cause.setAddressJS')
<script type="text/javascript">

  var lat = {{ $location['lat'] }};
  var lng = {{ $location['lon'] }};

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
    var geocoder = new google.maps.Geocoder;


  google.maps.event.addListener(marker, 'dragend', function(marker) {
    var latLng = setCoords(marker);
    geocoder.geocode({'location': latLng}, function(results, status) {
        setAddress(results);
      });
  });

  };

</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_APP_ID') }}&callback=initMap">
</script>
<script>
    $(document).ready(function() {
        $('#submit').click(function(a){
            var lat = $('input#lat').val();
            var lng = $('input#lat').val();
            if (lat == '' || lng == '') {
                alert('Muta markerul pe locatia cauzei!');
                a.preventDefault();
            }
        });
    });
</script>
@endsection