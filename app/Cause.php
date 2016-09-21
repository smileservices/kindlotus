<?php

namespace App;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Media;

class Cause extends Model
{

    protected $fillable = [
        'ngo_id', 'name', 'story', 'description', 'contact', 'active', 'success'
    ];

    /*
     * ACTIVE values:
     *
     * 0 - inactive
     * 1 - active request is pending to admin
     * 2 - approved and public
     *
     * */

    public function ngo()
    {
        return $this->belongsTo(Ngo::class);
    }

    /*
     *  Get the users that enlisted with the cause
     * */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_causes')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'causes_tags');
    }

    public function needs()
    {
        return $this->belongsToMany(Need::class, 'causes_needs');
    }

    public function updates()
    {
        return $this->hasMany(Update::class);
    }

    public function map()
    {
        return $this->hasOne(Map::class);
    }

    /*
     * Mark the cause as success
     * */
    public function setSuccess($success)
    {
        $this->success = $success;
        return $this->save();
    }

    public function setActive($active)
    {
        $this->active = $active;
        return $this->save();
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

    public function primaryImageThumb(){
        $image = $this->media()->image()->last();
        if ($image) {
            return url($image->url.'thumb_'.$image->name);
        } else {
            return url('assets/images/default_cause_thumb.jpg');
        }
    }

    public function isApproved()
    {
        if ($this->active == 2) return true;
        return false;
    }

    public function isSuccess()
    {
        if ($this->success == 1) return true;
        return false;
    }

    public function activePending()
    {
        if ($this->active == 1) return true;
        return false;
    }

    public function scopeActiveRequest($query)
    {
        return $query->where('active', 1)->orderBy('created_at')->get();
    }

    public function scopeActive($query)
    {
        return $query
            ->where('active', 2)
            ->where('success', 0)
            ->orderBy('created_at')->get();
    }

    public function scopeSuccess($query)
    {
        return $query
            ->where('success', 1)
            ->orderBy('created_at')->get();
    }

    public function scopePending($query)
    {
        return $query->where('active', 1)->orderBy('created_at')->get();
    }

    public function scopeInactive($query)
    {
        return $query->where('active', 0)->orderBy('created_at')->get();
    }

}
