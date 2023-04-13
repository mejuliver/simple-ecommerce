<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guarded = ['id'];
    protected $appends = ['is_admin','last_update'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function metas(){
        return $this->morphMany('App\Models\Meta','metaable');
    }

    function tags(){
        return $this->morphMany('App\Models\Tag','tagable');
    }

    function medias(){
        return $this->morphMany('App\Models\Media','mediaable');
    }

    function stores(){
        return $this->hasMany('App\Models\Store');
    }

    function addressBook(){
        return $this->hasMany('App\Models\AddressBook');
    }

    function shippingDetails(){
        return $this->hasMany('App\Models\AddressBook')->where('is_shipping',1);
    }

    function billingDetails(){
        return $this->hasMany('App\Models\AddressBook')->where('is_billing',1);
    }

    function coupons(){
        return $this->hasMany('App\Models\Coupon');
    }

    function brands(){
        return $this->hasMany('App\Models\Brand');
    }

    function products(){
        return $this->hasMany('App\Models\Product');
    }

    function inventories(){
        return $this->hasMany('App\Models\Inventory');
    }

    function categories(){
        return $this->hasMany('App\Models\Category');
    }

    function attributes(){
        return $this->hasMany('App\Models\Attribute');
    }

    function addressBooks(){
        return $this->hasMany('App\Models\AddressBook');
    }

    function reviews(){
        return $this->hasMany('App\Models\Review');
    }

    function orders(){
        return $this->hasMany('App\Models\Order');
    }

    function transactions(){
        return $this->hasMany('App\Models\Transaction');
    }

    function manufacturers(){
        return $this->hasMany('App\Models\Manufacturer');
    }

    function profile(){
        return $this->hasOne('App\Models\Profile','user_id');
    }

    function image_primary(){
        return $this->medias()->where('name','primary')->where('type','image')->first();
    }
    
    protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn() => \App\Models\AdminUser::where('user_id',$this->id)->exists()
        );
    }

    protected function lastUpdate(): Attribute
    {
        return Attribute::make(
            get: fn() => empty($this->updated_at) ? '--' : date_format(date_create($this->updated_at),'Y-m-d')
        );
    }


    public function delete()
    {
        // $this->profile()->delete();
        // $this->stores()->delete();
        // $this->meta()->delete();
        // $this->media()->delete();
        // $this->tag()->delete();

        // return parent::delete();
    }

    protected static function booted()
    {
        // static::deleted(function ($model) {
        // });
    }
}
