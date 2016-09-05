<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cause;
use App\Media;

class Update extends Model
{
    protected $fillable = ['title', 'content', 'active'];

    public function cause()
    {
        return $this->belongsTo(Cause::class);
    }
    public function updateable()
    {
        return $this->morphTo();
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

    public function setActive($active)
    {
        $this->active = $active;
        return $this->save();
    }

    public function scopeActive($query){
        return $query->where('active', 1)->orderBy('created_at')->get();
    }

    public function isActive(){
        return $this->active == 1;
    }

    public function destroySelf()
    {
        if (Media::deleteUpdateMedia($this)) {
            $this->delete();
            return true;
        } else {
            return false;
        }
    }
}
