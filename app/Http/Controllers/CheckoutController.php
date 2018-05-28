<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {	

    	$lat = request('lat');
    	$lng = request('lng');
    	$restaurant = Restaurant::findOrFail(request('restaurant_id'));

    	$sessionName = 'restaurant-' . $restaurant->id . '-coupon';

        

        $deliveryCharge = auth()->user()->orders()->count() >= 3 ? 30 : 0;

       // dd(\Cart::instance('restaurant-'.$restaurant->id)->content());


         $foodoorCash = 0;

         $gst = (floatval(\Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', ''))) * (5/100);

         $total =  ceil((floatval(\Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', ''))) + $deliveryCharge + $gst);

	     if(session()->has($sessionName))
    	 {  

             if(session($sessionName) == 'foodoorcash')
             {   
                $disc = auth()->user()->wallet_ballance * (10 / 100);

                if($disc > 150)
                {
                    $foodoorCash = 150;

                } else {
                    
                    $foodoorCash = $disc;
                
                }
              
                 $total =  ceil((floatval(\Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', ''))) - $foodoorCash + $deliveryCharge + $gst) ;

             } else {
                $coupon = Coupon::where('code',session($sessionName) )->first();
            
                $discount = $coupon->discount_type == 0 ? $coupon->discount : (floatval(\Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', '')))  * ($coupon->discount / 100);

                $total =  ceil((floatval(\Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', ''))) - $discount + $deliveryCharge + $gst) ;
             }

    		
	     } 



        $coupons = Coupon::all();

    	return view('checkout.index', compact('restaurant', 'lat', 'lng', 'sessionName', 'coupon', 'discount', 'coupons', 'total', 'gst', 'foodoorCash', 'deliveryCharge'));
    }


     public function success()
    {
    	return view('checkout.success');
    }
}
