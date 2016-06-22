<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function scopeInMost($query){
        return $query->orderBy('in','desc');
    }

    public function scopeInLeast($query){
        return $query->orderBy('in','asc');
    }
}
