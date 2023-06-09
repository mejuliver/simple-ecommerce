<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\CastAttribute as CastCastAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function meta(){
        return $this->morphMany('App\Models\Meta','metaable');
    }

    function media(){
        return $this->morphMany('App\Models\Media','mediaable');
    }

    function products(){
        return collect($this->meta()->where('name','CastAttribute')->with('product')->get())->map( fn($item) => $item->product )->all();
    }

    function image_primary(){
        return $this->medias()->where('name','primary')->where('type','image')->first();
    }

    function image_banner(){
        return $this->medias()->where('name','banner')->where('type','image')->first();
    }

    function images(){
        return $this->medias()->where('type','image')->get();
    }

    function meta_title(){
        $q = $this->metas()->where('name','title')->where('type','meta')->first();
        return $q ? $q->content : '';
    }

    function meta_description(){
        $q = $this->metas()->where('name','description')->where('type','meta')->first();
        return $q ? $q->content : '';
    }

    function meta_keywords(){
        $q = $this->metas()->where('name','keywords')->where('type','meta')->first();
        return $q ? $q->content : '';
    }
    
    protected function json(): CastAttribute
    {
        return CastAttribute::make(
            get: fn (string $value) => json_decode($value),
            set: fn (string $value) => json_encode($value),
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
