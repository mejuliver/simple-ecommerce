<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function products(){
        return collect(\App\Models\Meta::where('metaable_type','App\\Models\\Product')->where('content',$this->id)->where('name','category')->with('product')->get())->map( fn($item) => $item->store )->all();
    }

    function stores(){
        return collect(\App\Models\Meta::where('metaable_type','App\\Models\\Store')->where('content',$this->id)->where('name','category')->with('store')->get())->map( fn($item) => $item->store )->all();
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

    function sub_cats(){
        return $this->hasMany('App\Models\Category','parent_id','id');
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower(str_replace(' ','-',$value))
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

    public function scopeParent(Builder $query): void
    {
        $query->whereNull('parent_id');
    }

}
