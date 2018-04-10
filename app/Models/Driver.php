<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Driver extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'drivers';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [ 'user_id', 'phone', 'area' ];
    // protected $hidden = [];
    // protected $dates = [];

    public function getOrdersCountAttribute()
    {
        return 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function getFullNameAttribute()
    {
        return $this->user->name;
    }
}
