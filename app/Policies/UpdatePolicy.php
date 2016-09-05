<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Auth;
use App\Update;

class UpdatePolicy
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

    public function before()
    {
        if (Auth::guard('admin')->check()) {
            return true;
        }
    }

    /*
     * Delete an update
     *
     * Only owner (user or ngo) or Admin can delete
     *
     * */
    public function delete($owner, Update $update)
    {
        if ($owner->updates->contains($update)) {
            return true;
        } else {
            return false;
        }
    }

}
