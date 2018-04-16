<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Item $item)
    {
        \Cart::instance('restaurant-'.$item->restaurant->id)->add($item, 1);
        return back();
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function remove($item, Restaurant $restaurant)
    {
        \Cart::instance('restaurant-'.$restaurant->id)->remove($item);
        return back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function increment($item, Restaurant $restaurant)
    {   
        $count = \Cart::instance('restaurant-'.$restaurant->id)->get($item)->qty + 1;
        \Cart::instance('restaurant-'.$restaurant->id)->update($item, $count);
        return back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function decrement($item, Restaurant $restaurant)
    {
        $count = \Cart::instance('restaurant-'.$restaurant->id)->get($item)->qty - 1;
        
        if($count < 0)
        {
            $count = 0;
        }

        \Cart::instance('restaurant-'.$restaurant->id)->update($item, $count);
        
        return back();
    }
}
