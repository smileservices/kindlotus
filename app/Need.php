<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = ['tag'];
    public $timestamps = false;

    public function causes()
    {
        return $this->belongsToMany(Cause::class, 'causes_needs');
    }
    /* Return a Collection of all Active causes
    */
    public function causesActive()
    {
        return $this->causes()->active();
    }
    /* Return an array of all tags that are associated to causes
    */
    public static function allUsed()
    {
        $needs = Need::all();
        $allUsed = [];
        foreach($needs as $need){
            if  (count($need->causesActive()) > 0) array_push($allUsed, $need);
        }
        return $allUsed;
    }
}
