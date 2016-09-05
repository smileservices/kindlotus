<div class="row">
    <div class="col-md-12">
        <p class="text-right">
            <a class="facebook_share" rel="nofollow" href="http://www.facebook.com/share.php?u={{ $link }}" onclick="return fbs_click()" target="_blank" data-toggle="tooltip" title="Posteaza pe Facebook">
                <i class="fa fa-2x fa-facebook-square primary-light-text-color" aria-hidden="true"> </i>
            </a>
            <a target="_blank" href="https://plus.google.com/share?url={{ $link }}" onclick="window.open('https://plus.google.com/share?url={{ $link }}','Share on Google+','width=600,height=400,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;" data-toggle="tooltip" title="Posteaza pe Google+">
                <i class="fa fa-2x fa-google-plus-square primary-light-text-color" aria-hidden="true"> </i>
            </a>
            <a target="_blank" href="http://twitter.com/intent/tweet/?text={{ $cause->name }}&url={{ $link }}" onclick="window.open('http://twitter.com/intent/tweet/?text={{ $cause->name }}&url={{ $link }}','Share on Twitter','width=600,height=400,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;" data-toggle="tooltip" title="Posteaza pe Twitter">
                <i class="fa fa-2x fa-twitter-square primary-light-text-color" aria-hidden="true"> </i>
            </a>
        </p>
    </div>
</div>