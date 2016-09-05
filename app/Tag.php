<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag'];
    public $timestamps = false;

    public function causes()
    {
        return $this->belongsToMany(Cause::class, 'causes_tags');
    }

    public function causesActive()
    {
        return $this->causes()->active();
    }

    /* Return an array of all tags that are associated to causes
    */
    public static function allUsed()
    {
        $tags = Tag::all();
        $allUsed = [];
        foreach($tags as $tag){
            if  (count($tag->causesActive()) > 0) array_push($allUsed, $tag);
        }
        return $allUsed;
    }

}
