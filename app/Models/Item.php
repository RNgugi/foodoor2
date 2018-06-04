<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Item extends Model implements Buyable
{
    use CrudTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'items';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'slug', 'description', 'cuisine_id', 'restaurant_id', 'price', 'discount_price', 'photo', 'is_veg', 'toppings', 'sizes', 'featured'];
    // protected $hidden = [];
    // protected $dates = [];

    public function additions()
    {
        return $this->hasMany(Topping::class);
    }

    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class);
    }

    public function getCuisineNameAttribute()
    {
        return $this->cuisine->name;
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function manageToppings($crud = false)
    { 
      
       if(auth()->user()->isRestaurant())
       {
            return '<a class="btn btn-xs btn-success" href="/restaurants-admin/toppings?item=' . $this->id . '" data-toggle="tooltip" title="View Options/Toppings"><i class="fa fa-list-ul"></i> Additions/Options</a>';
       } else {
            return '<a class="btn btn-xs btn-success" href="/admin/toppings?item=' . $this->id . '" data-toggle="tooltip" title="View Options/Toppings"><i class="fa fa-list-ul"></i> Additions/Options</a>';
       }
        
       
    }


    public function getRestaurantNameAttribute()
    {
        return $this->restaurant->name;
    }

    public function getitemFullNameAttribute()
    {
        return $this->name . ' - ' . $this->restaurant->name;
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($this->attributes['name']);
    }

    /**
     * Get the identifier of the Buyable item.
     *
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }
    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }
    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        if(isset($this->customs))
        {
            return json_decode($this->customs)->price;
        }
        return $this->getPrice();
    }


    public function setPhotoAttribute($value)
    {
        $attribute_name = "photo";
        $disk = "public";
        $destination_path = "uploads/items";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function getPrice()
    {
        if($this->discount_price != '' &&  $this->discount_price != null)
        {
            return $this->discount_price;
        } else {

            if(check_in_range($this->restaurant->valid_from, $this->restaurant->valid_through, date('Y-m-d')))
            {
               $discount = $this->restaurant->discount_type == 0 ? $this->restaurant->discount : $this->price * ($this->restaurant->discount / 100);

               return ($this->price - $discount);
            }
            return $this->price;
            
        }
    }

    
     /*
    }
    |--------------------------------------------------------------------------
    | Methods for storing uploaded files (used in CRUD).
    |--------------------------------------------------------------------------
    */

    /**
     * Handle file upload and DB storage for a file:
     * - on CREATE
     *     - stores the file at the destination path
     *     - generates a name
     *     - stores the full path in the DB;
     * - on UPDATE
     *     - if the value is null, deletes the file and sets null in the DB
     *     - if the value is different, stores the different file and updates DB value.
     *
     * @param  [type] $value            Value for that column sent from the input.
     * @param  [type] $attribute_name   Model attribute name (and column in the db).
     * @param  [type] $disk             Filesystem disk used to store files.
     * @param  [type] $destination_path Path in disk where to store the files.
     */
    public function uploadFileToDisk($value, $attribute_name, $disk, $destination_path)
    {
        $request = \Request::instance();

        // if a new file is uploaded, delete the file from the disk
        if ($request->hasFile($attribute_name) &&
            $this->{$attribute_name} &&
            $this->{$attribute_name} != null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if the file input is empty, delete the file from the disk
        if (is_null($value) && $this->{$attribute_name} != null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if a new file is uploaded, store it on disk and its filename in the database
        if ($request->hasFile($attribute_name) && $request->file($attribute_name)->isValid()) {
            // 1. Generate a new file name
            $file = $request->file($attribute_name);
            $new_file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();

            // 2. Move the new file to the correct path
            $file_path = $file->storeAs($destination_path, $new_file_name, $disk);

            // 3. Save the complete path to the database
            $this->attributes[$attribute_name] = 'storage/' . $file_path;
        }
    }
  
}
