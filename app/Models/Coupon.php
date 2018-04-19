<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Coupon extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'coupons';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [ 'code', 'promo_text', 'discount_type', 'discount', 'restaurant_id', 'valid_from', 'valid_through', 'min_order', 'store_category'];
    // protected $hidden = [];
    // protected $dates = [];

     public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

     public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }

    public function getRestaurantNameAttribute()
    {
        return isset($this->restaurant) ? $this->restaurant->name : 'All Restaurants';
    }


    public function getDiscountTypeTextAttribute()
    {
        return $this->discount_type == 0 ? 'Flat' : 'Percentage';
    }
}
