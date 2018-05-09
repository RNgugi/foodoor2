<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Cuisine extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'cuisines';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [ 'name' ];
    // protected $hidden = [];
    // protected $dates = [];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
  
    public function getParentCuisineAttribute()
    {
        return isset($this->parent) ? $this->parent->name : '-';
    }

    public function getNameTreeAttribute()
    {
        return isset($this->parent) ? $this->name . ' --> ' . $this->parent->name : $this->name;
    }

    public function parent()
    {
        return $this->belongsTo(Cuisine::class, 'parent_id');
    }

    public function subs()
    {
        return $this->hasMany(Cuisine::class, 'parent_id');
    }

    public function getRestaurantsCountAttribute()
    {
        return count($this->restaurants);
    }

     public function __toString() {
        return $this->name;
    }

}
