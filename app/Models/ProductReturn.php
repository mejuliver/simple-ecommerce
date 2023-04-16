<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReturn extends Model
{
    protected $guarded = ['id'];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function meta(){
        return $this->morphMany('App\Models\Meta','metaable');
    }
}
