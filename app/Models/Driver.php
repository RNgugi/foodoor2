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
    protected $fillable = [ 'user_id', 'phone', 'area', 'contact_name', 'contact_email', 'profile_pic', 'legal_id'];
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

    public function setProfilePicAttribute($value)
    {
        $attribute_name = "profile_pic";
        $disk = "public";
        $destination_path = "uploads/drivers";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function setLegalIdAttribute($value)
    {
        $attribute_name = "legal_id";
        $disk = "public";
        $destination_path = "uploads/drivers";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
