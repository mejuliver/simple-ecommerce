<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class GiftCertificate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function metas(){
        return $this->morphMany('App\Models\Meta','metaable');
    }

    protected function content(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => html_decode($value),
            set: fn (string $value) => html_encode($value),
        );
    }

    protected function json(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value),
            set: fn (string $value) => json_encode($value),
        );
    }
}
