<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Auth;
use App\User;
use App\Ngo;
use App\Cause;

class CausePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

//    public function before($user, $ability)
//    {
//        if (Auth::guard('admin')->check()) {
//            return true;
//        }
//    }

    public function update($updater, Cause $cause)
    {
        return $updater->causes->contains($cause);
    }

    public function receiveUpdates($updater, Cause $cause)
    {
        return (($cause->active == 2) && $updater->causes->contains($cause));
    }

    public function delete($updater, Cause $cause)
    {
        if (Auth::guard('admin')->check()) {
            return true;
        } elseif (Auth::guard('ngo')->check()) {
            return $updater->causes->contains($cause);
        } else {
            return false;
        }
    }

    public function approve($updater, Cause $cause)
    {
        if (Auth::guard('admin')->check()) {
            return true;
        }else {
            return false;
        }
    }

}
