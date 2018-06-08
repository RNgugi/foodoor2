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
    public function customAdd(Item $item)
    {
        

        $customs = [];


        if(request()->has('size'))
        {
            $sizes = json_decode($item->sizes);

            $sizeKey = request('size');

            $size = $sizes[$sizeKey];

            $customs['size'] = $size->name;

            $customs['price'] = $size->price;


        } else {

            $customs['price'] =  $item->getPrice();
        }


      

        foreach ($item->additions as $key => $addition) {
            $choices = request(str_slug($addition->name));

            $given = json_decode($addition->options);

            if($choices != null) {

                if(is_array($choices))
                {   
                    $choosen = [];
                    foreach ($choices as $key => $choice) {
                        $choosen[] = $given[(int)$choice];
                          $customs['price'] += (int)(($given[(int)$choice]))->price;
                    }
                } else {
                    $choosen = $given[($choices)];

                     $customs['price'] += (int)$choosen->price;
                }

                $customs[str_slug($addition->name)] = $choosen;

            }
           



        }

        $item->customs = json_encode($customs);




        \Cart::instance('restaurant-'.$item->restaurant->id)->add($item, 1, ['customs' => $item->customs]);
        return back();
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function remove($item, Restaurant $restaurant)
    {   
        try{

          \Cart::instance('restaurant-'.$restaurant->id)->remove($item);
        } catch(Exception $e)
        {
            return back();
        }
        
        return back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function increment($item, Restaurant $restaurant)
    {   
        // $count = \Cart::instance('restaurant-'.$restaurant->id)->get($item)->qty + 1;
        \Cart::instance('restaurant-'.$restaurant->id)->update($item, request('newVal'));
        return back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function decrement($item, Restaurant $restaurant)
    {
        $count = request('newVal');
        
        if($count < 0)
        {
            $count = 0;
        }

        \Cart::instance('restaurant-'.$restaurant->id)->update($item, $count);
        
        return back();
    }
}
