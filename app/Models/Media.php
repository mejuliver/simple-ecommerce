<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Media extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function mediaable(){
        return $this->morphTo();
    }

    function metas(){
        return $this->morphMany('App\Models\Meta','metaable');
    }

    function tags(){
        return $this->morphMany('App\Models\Tag','tagable');
    }

}
