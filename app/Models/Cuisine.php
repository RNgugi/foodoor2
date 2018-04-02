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

    public function getRestaurantsCountAttribute()
    {
        return count($this->restaurants);
    }
}
