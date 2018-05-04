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
        return $this->belongsToMany(Item::class, 'order_item')->withPivot(['price', 'qty', 'customs']);
    }

    public function getStatusTextAttribute()
    {   
        $statuses = ['Order Placed', 'Confirmed by Restaurant', 'Order Ready' , 'Order Picked', 'Order Delivered'];
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

     public function confirmOrder($crud = false)
    { 
        if($this->status < 1)
        {
           return '<a class="btn btn-xs btn-success" href="/orders/'. $this->id . '/confirm" data-toggle="tooltip" title="Confirm Order"><i class="fa fa-check"></i> Confirm Order</a>';
        } else {

                 return '<a class="btn btn-xs btn-success" href="/orders/'. $this->id . '/confirm" data-toggle="tooltip" title="Confirm Order" disabled><i class="fa fa-check"></i> Order Confirmed</a>';
        }
       
    }

    public function viewOrder($crud = false)
    { 
      
           return 
           '<a class="btn btn-xs btn-primary" href="/orders/'. $this->id . '" data-toggle="tooltip" target="_blank" title="Confirm Order"><i class="fa fa-eye"></i> View</a>';
       
       
       
    }

}
