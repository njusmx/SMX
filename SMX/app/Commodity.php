<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $table = 'commodities';

    protected $primaryKey = 'id';

    protected $fillable = ['id','name', 'type','category','"numin','numout','avgin','avgout','lesswarn','morewarn','alarm'];

    public function scopeSoldMost($query){
        return $query->orderBy('numout','desc');
    }

    public function scopeSoldLeast($query){
        return $query->orderBy('numout','asc');
    }
}
