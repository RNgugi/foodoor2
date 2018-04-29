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

                        flash('Coupon was applied successfully')->success();


    				} else {
    					// show error ..

                       flash('Minimum order amount for this coupon should be ' . $coupon->min_order)->error();
    				}
    				
    			} else {
    				flash('Given coupon is not applicable to this restaurant')->error();
    			}
    			
    		} else {
    			flash('Given coupon is expired')->error();
    		}
    		
    	} else {
    		flash('Given coupon code is invalid')->error();
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
