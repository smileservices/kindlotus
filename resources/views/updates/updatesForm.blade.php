@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="panel panel-default mt20">
    <div class="panel-heading">
        <a class="collapsed" id="addUpdateButton" role="button" data-toggle="collapse" href="#addUpdate" aria-expanded="false" aria-controls="addUpdate">
        <i class="fa fa-plus-square-o" aria-hidden="true"></i>
 Adauga o noutate
        </a>
    </div>
    <div id="addUpdate" class="panel-collapse collapse" role="tabpanel">
		<div class="panel-body">

            <form action="{{ url('causes/'.$cause->id.'/update') }}" method="POST" enctype="multipart/form-data" multiple="multiple">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Titlul"/>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="content" cols="30" rows="3" placeholder="Continutul"></textarea>
                </div>

                <div class="form-group">
                    <label for="images">Incarca Imagini (optional)</label>
                    <input class="form-control" type="file" id="images" name="images[]" multiple/>
                </div>

                 <div class="form-group">
                    <label for="video">Clip Youtube (optional)</label>
                    <input class="form-control" type="text" id="video" name="video"/>
                 </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control">Update</button>
                </div>
                {{ csrf_field() }}
            </form>

        </div>
    </div>
</div>
