<!-- Get Involved Modal (logged)-->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="helpModalLabel">{{ $cause->name }}</h4>
      </div>
      <div class="modal-body">
 		<h4>Felicitari! Te-ai angajat sa ajuti cauza</h4>

 		<p>Incepe prin a face primul pas si promoveaza cauza pe retelele de socializare:</p>
 		<a target="_blank" href="http://www.facebook.com/share.php?u={{ url('causes/'.$cause->id) }}" onclick="return fbs_click()" target="_blank" data-toggle="tooltip" title="Posteaza pe Facebook" class="btn btn-social btn-facebook facebook_share">
            <span class="fa fa-facebook"></span> Facebook
        </a>
        <a class="btn btn-social btn-google" href="https://plus.google.com/share?url={{ url('causes/'.$cause->id) }}" onclick="window.open('https://plus.google.com/share?url={{ url('causes/'.$cause->id) }}','Share on Google+','width=600,height=400,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;" data-toggle="tooltip" title="Posteaza pe Google+">
            <span class="fa fa-google"></span> Google+
        </a>
        <a class="btn btn-social btn-twitter" href="http://twitter.com/intent/tweet/?text={{ $cause->name }}&url={{ url('causes/'.$cause->id) }}" onclick="window.open('http://twitter.com/intent/tweet/?text={{ $cause->name }}&url={{ url('causes/'.$cause->id) }}','Share on Twitter','width=600,height=400,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;" data-toggle="tooltip" title="Posteaza pe Twitter">
            <span class="fa fa-twitter"></span> Twitter
        </a>

        <span class="help-block"><a data-dismiss="modal" href="#">Nu doresc sa promovez cauza</a></span>
      </div>
    </div>
  </div>
</div>