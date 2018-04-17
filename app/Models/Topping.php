<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Topping extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'toppings';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'select_type', 'options', 'item_id'];
    // protected $hidden = [];
    // protected $dates = [];


    public function item()
    {
        return $this->belongsTo(Item::class);
    }

      public function getitemNameAttribute()
    {
        return $this->item->name;
    }
}
