<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function help(Cause $cause)
    {
        if (count($this->causes()->where('cause_id', $cause->id)->where('user_id', $this->id)->get()) > 0) {
            $status = 'duplicate';
        } else {
            if ($this->causes()->save($cause)) {
                $status = 'helped';
            }
        }
        return $status;
    }

    public function leave(Cause $cause)
    {
        return $this->causes()->detach($cause);
    }

    public function causes()
    {
        return $this->belongsToMany(Cause::class, 'users_causes')->withTimestamps();
    }

    public function toggleBan()
    {
        $active = 1;
        if ($this->active == $active) $active = 0;
        $this->active = $active;
        return $this->save();
    }

    public function updates()
    {
        return $this->morphMany(Update::class, 'updateable');
    }

    public function active()
    {
        if ($this->active == 1) return true;
        return false;
    }

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }
}
