<!-- Leave Modal (logged)-->
<div class="modal fade" id="leaveModal" tabindex="-1" role="dialog" aria-labelledby="leaveModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="leaveModalLabel">{{ $cause->name }}</h4>
      </div>
      <div class="modal-body">
 		<h4>Ne pare rau ca nu mai doresti sa participi la "{{ $cause->name }}"</h4>

 		<p>Confirmati parasirea cauzei:</p>
 		<form action="{{ url('causes/'.$cause->id.'/leave') }}" method="GET">
            <button class="btn btn-danger">Nu mai vreau sa particip</button>
            {{ csrf_field() }}
        </form>

      </div>
    </div>
  </div>
</div>