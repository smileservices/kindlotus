{{--Show updates--}}
<?php if (!isset($loggedUser)) $loggedUser = null; ?>

@foreach($updates as $update)
<?php
    $cause = $update->cause;
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
    @include('updates.listTemplate')
@endif

@endforeach