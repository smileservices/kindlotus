<form action="{{  url('search/causes') }}" method="POST">

<div class="form-group">
    <label class="control-label" for="area">Localizare </label>
    <div class=""  id="causes">
    <select class="form-control" name="area">
        <option selected value="all">Toate</option>
        @foreach($area as $area)
        <option {{ ($userArea == $area->area ? 'selected=selected' : '') }} value="{{ $area->area }}">{{ $area->area }}</option>
        @endforeach
    </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label" for="tags">Tipul cauzelor </label>
    <div class=""  id="causes">
    <select class="form-control" name="tags[]" multiple="multiple">
        @foreach($tags as $tag)
        <option selected value="{{ $tag->id }}">{{ $tag->tag }}</option>
        @endforeach
    </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label" for="needs">Cu ce vrei sa ajuti </label>
    <div class="" id="needs">
    <select class="form-control" name="needs[]" multiple="multiple">
        @foreach($needs as $tag)
        <option selected value="{{ $tag->id }}">{{ $tag->tag }}</option>
        @endforeach
    </select>
    </div>
</div>
{{ csrf_field() }}
<button class="btn btn-primary btn-block"><i class="fa fa-send"> </i> Afiseaza Rezultatele</button>

</form>