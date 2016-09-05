{{--Show updates--}}
<?php if (!isset($loggedUser)) $loggedUser = null; ?>

@foreach($updates as $update)
<?php
    $profile_link = url('ngo/profile/'.$cause->ngo['id']);
    $updater = get_class($update->updateable()->getRelated());
    if ( $updater == 'App\User') {
        $user = $update->updateable;
        $social_account = $user->socialAccounts()->where('provider', 'facebook')->first();
        if ($social_account != null) {
            $profile_link = 'https://www.facebook.com/'.$social_account->provider_user_id;
        } else {
            $profile_link = url('user/profile/'.$user->id);
        }
    }
 ?>

@if ($update->isActive() || Auth::guard('admin')->check())
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
 @endif

@endforeach