<script>
  {{--window.fbAsyncInit = function() {--}}
    {{--FB.init({--}}
      {{--appId      : '{{ env('FACEBOOK_APP_ID') }}',--}}
      {{--xfbml      : true,--}}
      {{--version    : 'v2.7'--}}
    {{--});--}}
  {{--};--}}

  {{--(function(d, s, id){--}}
     {{--var js, fjs = d.getElementsByTagName(s)[0];--}}
     {{--if (d.getElementById(id)) {return;}--}}
     {{--js = d.createElement(s); js.id = id;--}}
     {{--js.src = "//connect.facebook.net/en_US/sdk.js";--}}
     {{--fjs.parentNode.insertBefore(js, fjs);--}}
   {{--}(document, 'script', 'facebook-jssdk'));--}}

   {{--$('.facebook_share').click(function(event){--}}
       {{--event.preventDefault();--}}
       {{--FB.ui({--}}
         {{--method: 'share',--}}
         {{--mobile_iframe: true,--}}
         {{--href: '{{ url('causes/'.$cause->id) }}'--}}
       {{--}, function(response){});--}}
   {{--})--}}

  function fbs_click() {
        u='{{ url('causes/'.$cause->id) }}';
        t='{{ $cause->name }}';
        window.open(
            'http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),
            'sharer',
            'toolbar=0,status=0,width=626,height=436'
            );
        return false;
        }

</script>