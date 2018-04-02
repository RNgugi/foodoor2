<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Cuisine;
use App\Models\Item;
use Illuminate\Http\Request;

class RestaurantsController extends Controller
{
    /**
     * Display a landing page for restaurants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::limit(6)->get();
        $items = Item::limit(3)->get();
        $cuisines = Cuisine::limit(8)->get();
        return view('restaurants.index', compact('restaurants', 'cuisines', 'items'));
    }

    /**
     * Display a listing of the restaurants.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
         $restaurants = Restaurant::paginate(20);
        $cuisines = Cuisine::limit(8)->get();
        return view('restaurants.list', compact('restaurants', 'cuisines'));
    }


    public function getByCuisine(Cuisine $cuisine)
    {
        $restaurants = $cuisine->restaurants()->paginate(20);
        return view('restaurants.list', compact('restaurants', 'cuisine'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $items = $restaurant->items;
         return view('restaurants.show', compact('restaurant', 'items'));
    }

     public function showByCuisine(Restaurant $restaurant, Cuisine $cuisine)
    {
        $items = $restaurant->items()->where('cuisine_id', $cuisine->id)->get();
        return view('restaurants.show', compact('restaurant', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
