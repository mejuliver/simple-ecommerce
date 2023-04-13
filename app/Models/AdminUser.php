<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class AdminUser extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function user(){
        return $this->belongsTo('App\Models\User');
    }
}
