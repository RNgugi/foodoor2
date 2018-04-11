<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {	
    	$lat = request('lat');
    	$lng = request('lng');
    	$restaurant = Restaurant::findOrFail(request('restaurant_id'));
    	return view('checkout.index', compact('restaurant', 'lat', 'lng'));
    }


     public function success()
    {
    	return view('checkout.success');
    }
}
