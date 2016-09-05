<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = ['coordsX', 'coordsY', 'cause_id'];
    public $timestamps = false;
    public function cause(){
        return $this->belongsTo(Cause::class);
    }
}
