<!-- Get Involved Modal (logged)-->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="contactModalLabel">Trimite-ne un mesaj</h4>
      </div>
      <form action="{{ url('message') }}" method="POST">
          <div class="modal-body">
                <div class="form-group">
                    <input class="form-control" type="text" name="name" placeholder="Numele tau"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Adresa ta de email"/>
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="text" name="message" placeholder="Scrie aici mesajul tau" rows="5"/></textarea>
                </div>
          </div>
          <div class="modal-footer">
            {{ csrf_field() }}
            <button type="button" class="btn btn-default" data-dismiss="modal">Inchide</button>
            <button type="submit" class="btn btn-primary">Trimite</button>
          </div>
      </form>
    </div>
  </div>
</div>