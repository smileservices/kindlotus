<script>
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
</script>