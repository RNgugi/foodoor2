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

      if(request()->has('filter'))
      { 
            if(request('filter') == 'veg')
            {

              $restaurants = \DB::select("SELECT id,( 3959 * acos( cos( radians(". request('lat') .") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(". request('lng') .") ) + sin( radians(". request('lat') .") ) * sin( radians( latitude ) ) ) ) AS distance FROM restaurants WHERE is_veg = 1 HAVING distance < 5 ORDER BY distance LIMIT 0 , 20"); 

            } else if(request('filter') == 'nonveg') {
                $restaurants = \DB::select("SELECT id,( 3959 * acos( cos( radians(". request('lat') .") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(". request('lng') .") ) + sin( radians(". request('lat') .") ) * sin( radians( latitude ) ) ) ) AS distance FROM restaurants WHERE is_veg = 0 HAVING distance < 5 ORDER BY distance LIMIT 0 , 20"); 
            } else if(request('filter') == 'all') {
                $restaurants = \DB::select("SELECT id,( 3959 * acos( cos( radians(". request('lat') .") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(". request('lng') .") ) + sin( radians(". request('lat') .") ) * sin( radians( latitude ) ) ) ) AS distance FROM restaurants HAVING distance < 5  ORDER BY distance LIMIT 0 , 20"); 
            } else if(request('filter') == 'popular') {

                $restaurants = \DB::select("SELECT id,( 3959 * acos( cos( radians(". request('lat') .") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(". request('lng') .") ) + sin( radians(". request('lat') .") ) * sin( radians( latitude ) ) ) ) AS distance FROM restaurants WHERE rating > 3  HAVING distance < 5 ORDER BY distance LIMIT 0 , 20"); 
            }  else if(request('filter') == 'budget') {

                $restaurants = \DB::select("SELECT id,( 3959 * acos( cos( radians(". request('lat') .") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(". request('lng') .") ) + sin( radians(". request('lat') .") ) * sin( radians( latitude ) ) ) ) AS distance FROM restaurants WHERE min_price < 800  HAVING distance < 5 ORDER BY distance LIMIT 0 , 20"); 
            } 

      }  
      else if(request()->has('cuisine'))
      {
          $rids = \DB::select('SELECT restaurant_id from cuisine_restaurant WHERE cuisine_id =' . request('cuisine'));


          if(count($rids) > 0) {
             $resids = [];


              foreach ($rids as $key => $rid) {
                  $resids[] = $rid->restaurant_id;
              }
                            
              $restaurants = \DB::select("SELECT id,( 3959 * acos( cos( radians(". request('lat') .") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(". request('lng') .") ) + sin( radians(". request('lat') .") ) * sin( radians( latitude ) ) ) ) AS distance FROM restaurants WHERE id IN (". implode(',', $resids) .") HAVING distance < 5 ORDER BY distance LIMIT 0 , 20"); 
          } else {
                 $restaurants = [];
          }
          

      } 
      else {

          $restaurants = \DB::select("SELECT id,( 3959 * acos( cos( radians(". request('lat') .") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(". request('lng') .") ) + sin( radians(". request('lat') .") ) * sin( radians( latitude ) ) ) ) AS distance FROM restaurants HAVING distance < 5 ORDER BY distance LIMIT 0 , 20"); 
      }
     

      $filteredRestaurants = [];

      foreach($restaurants as $restaurant)
      {
          $res = Restaurant::findOrFail($restaurant->id);

          $res->delivery_time = $restaurant->distance < 5 ? '40 Min' : '45 Min';

          $filteredRestaurants[] = $res;
      }

      $restaurants = $filteredRestaurants;

      if(count($restaurants) == 0)
      {
        // flash message
        flash('We are currently not serving in that location. Please choose a servicable locaiton.')->warning();
        return redirect('/');
      }

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

    public function cmp($a, $b)
    {
        return strcmp($a->name, $b->name);
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {   
       $restaurant->distance = ( 3959 * acos( cos( deg2rad(request('lat')) ) * cos( deg2rad( $restaurant->latitude ) ) * cos( deg2rad( $restaurant->longitude ) - deg2rad(request('lng')) ) + sin( deg2rad(request('lat')) ) * sin( deg2rad( $restaurant->latitude ) ) ) );

       $restaurant->delivery_time = $restaurant->distance > 3 ? '45 min' : '40 min';

        $items = $restaurant->items()->orderBy('name')->get();

        $cuisineIds = $items->groupBy('cuisine_id');

        dd($cuisineIds);

        $cuisines = [];

        foreach ($cuisineIds as $key => $cuisine) {
            $cuisines[] = Cuisine::findOrFail($cuisine)->first();
        }



         usort($cuisines, array($this, "cmp"));




         return view('restaurants.show', compact('restaurant', 'items', 'cuisines'));
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


    public function getAjax(){
       $term = request('term');
       $options = Restaurant::where('name', 'like', '%'.$term.'%')->get();
       return $options->pluck('name', 'id');
    }
}
