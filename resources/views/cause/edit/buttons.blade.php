<div class="panel panel-default">
    <div class="panel-heading">
      <a id="deleteDisableButton" role="button" data-toggle="collapse" href="#deleteDisable" aria-expanded="false" aria-controls="deleteDisable">
      <i class="fa fa-edit"></i> Activeaza/Sterge
      </a>
    </div>
    <div id="deleteDisable" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="deleteDisablePanel">
        <div class="panel-body">
        @if($cause->activePending())
            <div class="col-xs-12">
                <div class="alert alert-info">
                    Se asteapta aprobarea
                </div>
            </div>
        @endif
            <div class="col-xs-4">
                <form action="{{ url('causes/'.$cause->id.'/active') }}" method="POST">
                    <div class="form-group">
                        @if($cause->isApproved() || ($cause->activePending() && Auth::guard('ngo')->check()))
                        <button type="submit" class="btn btn-danger form-control">
                        Dezactiveaza
                        </button>
                        <input type="hidden" name="active" value="0"/>
                        @elseif (Gate::forUser(Auth::guard('admin')->user())->allows('approve', $cause))
                        <button type="submit" class="btn btn-success form-control">
                        Aproba
                        </button>
                        <input type="hidden" name="active" value="2"/>
                        @else
                        <button type="submit" class="btn btn-success form-control">
                        Trimite spre aprobare
                        </button>
                        <input type="hidden" name="active" value="1"/>
                        @endif
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="col-xs-4">
             <form action="{{ url('causes/'.$cause->id) }}" method="POST">
                  <div class="form-group">
                      <button type="submit" class="btn btn-danger form-control">Sterge</button>
                  </div>
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value="DELETE"/>
              </form>
            </div>
            <div class="col-xs-4">
               <form action="{{ url('causes/'.$cause->id).'/success' }}" method="POST">
                    <div class="form-group">
                    <button type="submit" class="btn btn-success form-control">
                    Marcheaza Succes
                    </button>
                    <input type="hidden" name="success" value="1"/>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
  </div>
  </div>