<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = ['coordsX', 'coordsY', 'country', 'area', 'city', 'cause_id'];
    public $timestamps = false;
    
    public function cause()
    {
        return $this->belongsTo(Cause::class);
    }

    /*  Return all area used by the active causes
     *
     * */
    public static function allAreaUsed()
    {
        return self::distinct()->select('area')->join('causes', 'causes.id', '=', 'maps.cause_id')->where('causes.active', 2)->get();
    }
}
