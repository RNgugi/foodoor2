<?php

namespace App;

use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;// <---------------------- and this one
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Password;

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
        'name', 'email', 'password', 'phone', 'is_verified', 'wallet_ballance'
    ];

    protected $appends = ['is_driver'];

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

    public function driver()
    {
        return $this->hasOne(Driver::class, 'user_id');
    }

    public function isRestaurant()
    {
        return $this->restaurant != null;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

     public function generateToken()
    {
        if($this->api_token == null) {
        $token = substr(Password::getRepository()->createNewToken(), 0, 58);
          if (User::where('api_token', '=', $token)->exists()) {
                //Model Found -- call self.
                self::generate($length, $modelClass, $fieldName);
            } else {
                $this->api_token = $token;
                $this->save();
            }
       }
        
    }


    public function getIsDriverAttribute()
    {
        return $this->driver != null;
    }
}
