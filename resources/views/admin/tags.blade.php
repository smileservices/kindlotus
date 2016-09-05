@extends('layouts.app')

@section('content')

<div class="container mt20">

    <div class="panel panel-default">
        <div class="panel-heading">
            Causes Tags
        </div>
        <div class="panel-body">
            <div class="well">
            @foreach($tags as $tag)
            <a href="{{ url('admin/tags/'.$tag->id) }}"><span class="causes_tag">{{ $tag->tag }}</span></a>
            @endforeach
            </div>
            <form action="{{ url('admin/tags') }}" method="POST">
                <div class="form-group">
                    <label for="tag">Tag Name</label>
                    <input class="form-control" type="text" name="tag"/>
                </div>
                {{ csrf_field() }}
                <button class="btn btn-primary btn-block" name="type" value="tag" type="submit">Add</button>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Needs Tags
        </div>
        <div class="panel-body">
            <div class="well">
            @foreach($needs as $tag)
            <a href="{{ url('admin/needs/'.$tag->id) }}"><span class="needs_tag">{{ $tag->tag }}</span></a>
            @endforeach
            </div>
            <form action="{{ url('admin/tags') }}" method="POST">
                <div class="form-group">
                    <label for="tag">Tag Name</label>
                    <input class="form-control" type="text" name="tag"/>
                </div>
                {{ csrf_field() }}
                <button class="btn btn-primary btn-block" name="type" value="need" type="submit">Add</button>
            </form>
        </div>
    </div>

</div>

@endsection