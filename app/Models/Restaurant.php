<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

use App\User;

class Restaurant extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

   


    protected $table = 'restaurants';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [ 'name', 'slug', 'area', 'pincode', 'location', 'logo','contact_name', 'contact_phone', 'contact_email', 'website', 'city_id', 'open_time',
        'close_time', 'bank_name', 'bank_ifsc', 'bank_acc_no', 'bank_acc_name', 'bank_acc_type', 'rating', 'promo_text', 'discount_type', 'discount', 'valid_from', 'valid_through'];

    protected $casts = [
        'photos' => 'array'
    ];

     public function account()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getCityNameAttribute()
    {
        return $this->city->name;
    }

    public function cuisines()
    {
        return $this->belongsToMany(Cuisine::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }


    
}
