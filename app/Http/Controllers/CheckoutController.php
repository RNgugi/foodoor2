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


       // dd(\Cart::instance('restaurant-'.$restaurant->id)->content());

    	if(session()->has($sessionName))
    	{
    		$coupon = Coupon::where('code',session($sessionName) )->first();
    		$discount = $coupon->discount_type == 0 ? $coupon->discount : (\Cart::instance('restaurant-'.$restaurant->id)->subtotal() * (5/100) + 20) * ($coupon->discount / 100);
	    }

    	return view('checkout.index', compact('restaurant', 'lat', 'lng', 'sessionName', 'coupon', 'discount'));
    }


     public function success()
    {
    	return view('checkout.success');
    }
}
