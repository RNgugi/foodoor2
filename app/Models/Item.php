<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Item extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'items';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'slug', 'description', 'cuisine_id', 'restaurant_id', 'price', 'photo'];
    // protected $hidden = [];
    // protected $dates = [];

    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class);
    }

    public function getCuisineNameAttribute()
    {
        return $this->cuisine->name;
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function getRestaurantNameAttribute()
    {
        return $this->restaurant->name;
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($this->attributes['name']);
    }

  
}
