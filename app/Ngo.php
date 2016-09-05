<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Ngo extends Authenticatable
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

    public function causes()
    {
        return $this->hasMany(Cause::class);
    }

    public function updates()
    {
        return $this->morphMany(Update::class, 'updateable');
    }

    public function causesActive(){
        return $this->causes()->where('active', 1)->get();
    }

    public function active()
    {
        if ($this->active == 1) return true;
        return false;
    }
}
