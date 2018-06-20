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
        $suggestion = request('suggestion');

    	$lat = request('lat');
    	$lng = request('lng');
    	$restaurant = Restaurant::findOrFail(request('restaurant_id'));

    	$sessionName = 'restaurant-' . $restaurant->id . '-coupon';

        

        $deliveryCharge = auth()->user()->orders()->count() >= 3 ? 30 : 0;

       // dd(\Cart::instance('restaurant-'.$restaurant->id)->content());

        $subtotal = floatval(\Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', ''));

         $foodoorCash = 0;

         if($restaurant->apply_gst)
         {
             $gst = (floatval(\Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', ''))) * (5/100);
         } else {
            $gst = 0;
         }
          

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

                $discount = $discount > 150 ? 150 : $discount;

                $total =  ceil((floatval(\Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', ''))) - $discount + $deliveryCharge + $gst) ;
             }

    		
	     } 



        $couponsList = Coupon::all();

        $coupons = [];

        foreach ($couponsList as $key => $coupon) {
            if(check_in_range($coupon->valid_from, $coupon->valid_through, date('Y-m-d')))
            {
                if($coupon->applied_to_all || $coupon->restaurants->contains($restaurant))
                {
                    $coupons[] = $coupon;
                }
            }
        }

        if($subtotal < 99)
        {
            $foodoorCash = 0;

             if(session($sessionName) == 'foodoorcash')
             {
                session()->forget($sessionName);
             }
        }

    	return view('checkout.index', compact('restaurant', 'lat', 'lng', 'sessionName', 'coupon', 'discount', 'coupons', 'total', 'gst', 'foodoorCash', 'deliveryCharge', 'subtotal'));
    }


     public function success()
    {
    	return view('checkout.success');
    }
}
