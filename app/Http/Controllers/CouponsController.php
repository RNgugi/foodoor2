<?php

namespace App\Http\Controllers;


use App\Models\Coupon;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function apply(Restaurant $restaurant, $code)
    {
    	$sessionName = 'restaurant-' . $restaurant->id . '-coupon';

    	if(Coupon::where('code', $code)->exists())
    	{	
    		$coupon = Coupon::where('code', $code)->first();
    		if(check_in_range($coupon->valid_from, $coupon->valid_through, date('Y-m-d')))
    		{

    			if($coupon->restaurant_id == null || $coupon->restaurant_id == $restaurant->id)
    			{

    				if(\Cart::instance('restaurant-'.$restaurant->id)->subtotal() > $coupon->min_order)
    				{
    					
    					session([$sessionName   => $code]);
    				} else {
    					// show error ..
    				}
    				
    			} else {
    				// show error ..
    			}
    			
    		} else {
    			// show error ..
    		}
    		
    	} else {
    		// show error..
    	}
    	

    	return back();
    }

    public function remove(Restaurant $restaurant, $code)
    {
    	$sessionName = 'restaurant-' . $restaurant->id . '-coupon';
    	
    	session()->forget($sessionName);
    	

    	return back();
    }
}
