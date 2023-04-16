<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    function inventory(){
        return $this->belongsTo('App\Models\Inventory');
    }

    function store(){
        return $this->belongsTo('App\Models\Store');
    }

    function manufacturer(){
        return $this->belongsTo('App\Models\Manufacturer');
    }

    function reviews(){
        return $this->hasMany('App\Models\Review');
    }

    function metas(){
        return $this->morphMany('App\Models\Meta','metaable');
    }

    function tags(){
        return $this->morphMany('App\Models\Tag','tagable');
    }

    function medias(){
        return $this->morphMany('App\Models\Media','mediaable');
    }

    function options(){
        return $this->metas()->where('name','option')->where('type','option')->get();
    }

    function attributes(){
        return $this->metas()->where('name','attribute')->with('attribute')->get();
    }

    function categories(){
        return $this->metas()->where('name','category')->where('type','category')->with('category')->get();
    }

    function ads(){
        return $this->metas()->where('name','ad')->where('type','ad')->with('ad')->get(); 
    }

    function files(){
        return $this->medias()->where('type','file')->get();
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

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower(str_replace(' ','-',$value))
        );
    }

    protected function fileUrlJson(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value),
            set: fn (string $value) => json_encode($value),
        );
    }

    protected function json(): Attribute
    {
        return Attribute::make(
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
