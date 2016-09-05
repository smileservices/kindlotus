@section('extraJs')
@include('media.js')

@if(session('status'))
    <?php $status = session('status'); ?>
    @if($status == 'helped')
        <script>
            $('#helpModal').modal('show');
        </script>
    @elseif($status == 'left')
        <script>
            $('#leaveConfirmationModal').modal('show');
        </script>
    @elseif($status == 'duplicate')
        <script>
            $('#duplicateModal').modal('show');
        </script>
    @endif
@endif

@include('cause.show.fbJS')
<script>
var causeTitle = "{{ $cause->name }}";
function initMap() {

  var myLatLng = {
    lat: {{ $cause->map['coordsX'] }},
    lng:{{ $cause->map['coordsY'] }}
  };

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: causeTitle,
    draggable: false
  });

 }

$('#show_map').click(function(){
 $('#map_container').toggle();
 initMap();
})

</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_APP_ID') }}&callback=initMap">
</script>
@endsection