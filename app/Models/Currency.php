<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function metas(){
        return $this->morphMany('App\Models\Meta','metaable');
    }

    protected function json(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value),
            set: fn (string $value) => json_encode($value),
        );
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower(str_replace(' ','-',$value))
        );
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }

    public function scopeInactive(Builder $query): void
    {
        $query->where('is_active', 0);
    }
}
