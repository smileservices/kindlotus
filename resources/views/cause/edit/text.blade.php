      <div class="panel panel-default">
        <div class="panel-heading">
          <a class="collapsed" id="editDetailsButton" role="button" data-toggle="collapse" href="#editDetails" aria-expanded="false" aria-controls="editDetails">
          <i class="fa fa-edit"></i> Nume, poveste, adresa, coordonate
          </a>
        </div>
         <div id="editDetails" class="panel-collapse collapse" role="tabpanel" aria-labelledby="editDetailsPanel">
        <div class="panel-body">

          <form action="{{ url('causes/'.$cause->id) }}" method="POST">
            <div class="form-group">
              <label for="">Numele Cauzei</label>
              <input class="form-control" type="text" name="name" value="{{ $cause->name or ''}}">
            </div>

            <div class="form-group">
              <label for="">Scurta descriere (255 caractere)</label>
              <textarea class="form-control" name="description" cols="30" rows="3">{{ $cause->description or '' }}</textarea>
            </div>
            <div class="form-group">
              <label for="">Povestea</label>
              <textarea class="form-control" name="story" cols="30" rows="10">{{ $cause->story or '' }}</textarea>
            </div>

            <div class="form-group" id="causes">
              <label class="control-label" for="tags">Tipul cauzei</label>
              <select class="form-control" name="tags[]" multiple="multiple">
                @foreach($tags as $tag)
                    <option {{ ($cause->tags->find($tag->id) ? 'selected' : '') }} value="{{ $tag->id }}">{{ $tag->tag }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group" id="needs">
              <label class="control-label" for="needs">Cu ce putem ajuta</label>
              <select class="form-control" name="needs[]" multiple="multiple">
                @foreach($needs as $tag)
                    <option {{ ($cause->tags->find($tag->id) ? 'selected' : '') }} value="{{ $tag->id }}">{{ $tag->tag }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="">Datele de contact pentru voluntari</label>
              <textarea class="form-control" name="contact" cols="30" rows="3">{{ $cause->story or '' }}</textarea>
            </div>

            <div class="form-group">
              <label for="">Seteaza pozitia pe harta</label>
              <div id="map_container">
                <div id="map"></div>
              </div>
            </div>

            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="lng" name="lng">

            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PATCH"/>
            <button id="" class="btn btn-primary btn-block" name="submit" value="text_update">
              Trimite
            </button>
            </form>

        </div>
        </div>
      </div>