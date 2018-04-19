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

    			if($coupon->applied_to_all || $coupon->restaurants->contains($restaurant))
    			{

    				if(floatval(\Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', '')) > $coupon->min_order)
    				{
    					
    					session([$sessionName   => $code]);
    				} else {
    					// show error ..

                        dd('Here 1');
    				}
    				
    			} else {
    				dd('Here 2');
    			}
    			
    		} else {
    			dd('Here 3');
    		}
    		
    	} else {
    		dd('Here 4');
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
