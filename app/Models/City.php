<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class City extends Model
{
    use CrudTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'cities';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [ 'name' ];
    // protected $hidden = [];
    // protected $dates = [];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }

    public function getRestaurantsCountAttribute()
    {
        return count($this->restaurants);
    }
   
}
