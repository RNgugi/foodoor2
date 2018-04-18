<?php

namespace App;

use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;// <---------------------- and this one
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use CrudTrait; // <----- this
    use HasRoles; // <------ and this

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function restaurant()
    {
        return $this->hasOne(Restaurant::class, 'account_id');
    }

    public function isRestaurant()
    {
        return $this->restaurant != null;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
