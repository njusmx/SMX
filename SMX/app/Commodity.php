<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $table = 'commodities';

    protected $primaryKey = 'id';

    protected $fillable = ['id','name', 'type','category','"numin','numout','avgin','avgout','lesswarn','morewarn','alarm'];
}
