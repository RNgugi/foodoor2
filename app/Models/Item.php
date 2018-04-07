<?php

namespace App\Models;


use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Item extends Model implements Buyable
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
    protected $fillable = ['name', 'slug', 'description', 'cuisine_id', 'restaurant_id', 'price', 'photo', 'is_veg', 'toppings', 'sizes'];
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

    /**
     * Get the identifier of the Buyable item.
     *
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }
    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }
    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }
  
}
