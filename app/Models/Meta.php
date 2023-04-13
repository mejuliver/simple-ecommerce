<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Meta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function product(){        
        return $this->hasOne('\App\Models\Product','id','content');
    }

    function category(){        
        return $this->hasOne('\App\Models\Category','id','content');
    }

    function attribute(){        
        return $this->hasOne('\App\Models\Attribute','id','content');
    }

    function store(){
        return $this->hasOne('\App\Models\Store','id','content');
    }

    function manufacturer(){
        return $this->hasOne('\App\Models\Manufacturer','id','content');
    }

    function ad(){
        return $this->hasOne('\App\Models\Ad','id','content');
    }

    function user(){        
        return $this->hasOne('\App\Models\User','id','content');
    }

    function metaable(){
        return $this->morphTo();
    }

    protected function content(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->type == 'json' ? json_decode($value) : $value,
            set: fn (string $value) => $this->type == 'json' ? json_encode($value) : $value,
        );
    }
}
