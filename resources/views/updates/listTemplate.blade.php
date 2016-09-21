<div class="panel panel-{{ ($update->isActive() ? 'default' : 'danger') }}">
    <div class="panel-heading">
        <strong>{{ ($showCause ? $update->cause->name.' - ' : '') }}{{ $update->title }}</strong> <br/>
        de <a target="_blank" href="{{ $profile_link }}">{{ $update->updateable->name }}</a> in data de {{ date('F d, Y', strtotime($update->created_at)) }}
        @if($updater == 'App\User')
            <a href="{{ url('user/profile/'.$user->id) }}" data-toggle="tooltip" title="Vezi profilul"><i class="fa fa-user pull-right"></i></a>
        @endif
        @if(Gate::forUser($loggedUser)->allows('delete', $update))
            <a href="{{ url('updates/'.$update->id.'/delete') }}" data-toggle="tooltip" title="Sterge"><i class="fa fa-trash-o pull-right"></i></a>
        @endif
        @if ($update->isActive())
            @include('updates.visible')
        @else
            @include('updates.hidden')
        @endif
    </div>
    <div class="panel-body">
        <p>{{ $update->content }}</p>
        @include('media.media', ['medias' => $update->media, 'cause' => $update->cause, 'isUpdate' => true])
    </div>
 </div>