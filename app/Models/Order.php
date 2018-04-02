<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\User;

class Order extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $guarded = [];
    // protected $hidden = [];
    // protected $dates = [];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function getRestaurantNameAttribute()
    {
        return $this->restaurant->name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCustomerNameAttribute()
    {
        return $this->user->name;
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_item');
    }

    public function getStatusTextAttribute()
    {   
        $statuses = ['Order Placed', 'Order Picked', 'Order Delivered'];
        return $statuses[$this->status];
    }


     public function getItemsCountAttribute()
    {
        return count($this->items);
    }

    public function getAmountAttribute()
    {
        return  $this->attributes['amount'];
    }

    public function getCommissionEarnedAttribute()
    {
        return $this->amount * (10/100);
    }

}
