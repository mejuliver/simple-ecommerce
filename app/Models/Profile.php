<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ['last_update'];
    protected $guarded = ['id'];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    protected function lastUpdate(): Attribute
    {
        return Attribute(
            get: fn() => empty($this->updated_at) ? '--' : date_format(date_create($this->updated_at),'Y-m-d')
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
