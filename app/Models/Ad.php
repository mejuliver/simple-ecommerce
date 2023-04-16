<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $fillable = ['user_id','ad_id','slug','name','excerpt','details','is_featured','json','notes','is_active'];
    protected $casts = [
        'user_id' => 'integer',
        'ad_id' => 'integer',
        'slug' => 'string',
        'name' => 'string',
        'excerpt' => 'string',
        'is_featured' => 'integer',
        'json' => 'array',
        'notes' => 'string',
        'is_active' => 'integer'
    ];

    function user(){
        return $this->belongsTo('App\Models\User');
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

}
