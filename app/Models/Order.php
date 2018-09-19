<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\User;

class Order extends Model
{
    use CrudTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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

    protected $with = ['user', 'restaurant'];

    protected $appends = ['paying_status', 'order_status', 'payable_amount', 'total_amount', 'tax_amount', 'customer_address', 'door_no', 'landmark', 'alt_mobile', 'road_name', 'latitude', 'longitude'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function getRestaurantNameAttribute()
    {
        return isset($this->restaurant) ? $this->restaurant->name : 'NOT EXIST';
    }

    public function user()
    {

        return $this->belongsTo(User::class);

    }

    public function getCustomerNameAttribute()
    {
        if($this->user)
        {
            return $this->user->name;
        } else {
            return 'NOT EXIST';
        }

    }

    public function getUserNameAttribute()
    {
        return isset($this->user_name) ?  $this->user_name : $this->customer_name;
    }

    public function getUserPhoneAttribute()
    {
        return isset($this->user_phone) ?  $this->user_phone : $this->user->phone;
    }

     public function getUserEmailAttribute()
    {
        return isset($this->user_email) ?  $this->user_email : $this->user->email;
    }

      public function getPhoneNoAttribute()
    {
        if($this->user)
        {
            return $this->user->phone;
        } else {
            return $this->phone;
        }

    }

     public function getBookingDateAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_item')->withPivot(['price', 'qty', 'customs', 'custom_toppings']);
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
        return $this->subtotal * ($this->restaurant->commission/100);
    }

    public function getAmountEarnedAttribute()
    {
        return $this->subtotal - $this->commission_earned;
    }

     public function confirmOrder($crud = false)
    {
        if($this->status < 1)
        {
           return '<a class="btn btn-xs btn-success" href="/orders/'. $this->id . '/confirm" data-toggle="tooltip" title="Confirm Order"><i class="fa fa-check"></i> Confirm Order</a>';
        } elseif($this->status == 1) {

                 return '<a class="btn btn-xs btn-info" href="/orders/'. $this->id . '/ready" data-toggle="tooltip" title="Order Ready" ><i class="fa fa-check"></i> Order Ready</a>';
        } elseif($this->status == 2) {

                 return '<a class="btn btn-xs btn-info" href="/orders/'. $this->id . '/picked" data-toggle="tooltip" title="Order Picked" ><i class="fa fa-check"></i> Order Picked</a>';
        } elseif($this->status == 3) {

                 return '<a class="btn btn-xs btn-success" href="/orders/'. $this->id . '/delivered" data-toggle="tooltip" title="Order Delivered" ><i class="fa fa-check"></i> Order Delivered</a>';
        } else {
             return '<a class="btn btn-xs btn-success" href="#" data-toggle="tooltip" title="Order Delivered" disabled><i class="fa fa-check"></i> Order Closed</a>';
        }

    }

    public function viewOrder($crud = false)
    {

           return
           '<a class="btn btn-xs btn-danger" href="/orders/'. $this->id . '" data-toggle="tooltip" target="_blank" title="Confirm Order"><i class="fa fa-eye"></i> View</a>';



    }


    public function invoice($crud = false)
    {

           return
           '<a class="btn btn-xs btn-primary" href="/orders/'. $this->id . '/invoice" data-toggle="tooltip" target="_blank" title="Confirm Order"><i class="fa fa-file-text"></i> Invoice</a>';



    }

    public function getPayableAmountAttribute()
    {
        return $this->amount;
    }

    public function getTotalAmountAttribute()
    {
        return $this->subtotal;
    }

    public function getTaxAmountAttribute()
    {
        return $this->tax;
    }

    public function getPayingStatusAttribute()
    {
        return $this->payment_mode == 0 ? 'cod' : 'online';
    }

    public function getOrderStatusAttribute()
    {
        if($this->status == 1)
        {
            return 'confirmed';
        } else if($this->status == 2)
        {
            return 'ready';
        } else if($this->status == 3)
        {
            return 'picked';
        } else if($this->status == 4)
        {
            return 'delivered';
        }
    }

    public function getCustomerAddressAttribute()
    {
        return json_decode($this->delivery_address)->delivery_location;
    }

    public function getLandmarkAttribute()
    {
        return json_decode($this->delivery_address)->landmark;
    }

    public function getDoorNoAttribute()
    {
        return json_decode($this->delivery_address)->door_no;
    }

    public function getRoadNameAttribute()
    {
        return json_decode($this->delivery_address)->road_name;
    }

    public function getAltMobileAttribute()
    {
        return json_decode($this->delivery_address)->alt_mobile;
    }

     public function getLatitudeAttribute()
    {
        return json_decode($this->delivery_address)->lat;
    }

     public function getLongitudeAttribute()
    {
        return json_decode($this->delivery_address)->lng;
    }





}
