<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Order;
use App\Events\OrderStatusChanged;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{

    public function confirmOrder(Order $order)
    {
        $user = request()->user();

        if(!$user)
        {
            return response(['status' => 'failed', 'message' => 'User doesn\'t exist!']);
        }

        if(!$user->is_restaurant)
        {
            return response(['status' => 'failed', 'message' => 'User should be a restaurant!']);
        }

        if($order->restaurant_id != 0)
        {
            return response(['status' => 'failed', 'message' => 'The order belongs to other restaurant!']);
        }

        $order->status = 1;
        $order->save();

        event(new OrderStatusChanged($order));

        // send user message;

        return response(['status' => 'success', 'message' => 'Order Confirmed!']);
    }




    public function orderReady(Order $order)
    {
        $user = request()->user();

        if(!$user)
        {
            return response(['status' => 'failed', 'message' => 'User doesn\'t exist!']);
        }

        if(!$user->is_restaurant)
        {
            return response(['status' => 'failed', 'message' => 'User should be a restaurant!']);
        }

        if($order->restaurant_id != 0)
        {
            return response(['status' => 'failed', 'message' => 'The order belongs to other restaurant!']);
        }

        $order->status = 2;
        $order->save();

        event(new OrderStatusChanged($order));

        // send user message;

        return response(['status' => 'success', 'message' => 'Order Confirmed!']);

    }

    public function readyOrders()
    {
        $user = request()->user();

        if(!$user)
        {
            return response(['status' => 'failed', 'message' => 'User doesn\'t exist!']);
        }

        if(!$user->is_restaurant)
        {
            return response(['status' => 'failed', 'message' => 'User should be a restaurant!']);
        }



        $orders = Order::where('status', '=', 2)->where('restaurant_id', $user->restaurant->id)->with('restaurant')->with('user')->get();

        return response(['status' => 'success', 'message' => 'All Ready Orders!', 'orders' => $orders], 200);

    }


    public function orders()
    {
        $user = request()->user();

        if(!$user)
        {
            return response(['status' => 'failed', 'message' => 'User doesn\'t exist!']);
        }

        if(!$user->is_restaurant)
        {
            return response(['status' => 'failed', 'message' => 'User should be a restaurant!']);
        }



        $orders = Order::where('status', '<', 4)->where('restaurant_id', $user->restaurant->id)->with('restaurant')->with('user')->get();

        return response(['status' => 'success', 'message' => 'All New Orders!', 'orders' => $orders], 200);

    }

    public function history()
    {
        $user = request()->user();

        if(!$user)
        {
            return response(['status' => 'failed', 'message' => 'User doesn\'t exist!']);
        }

        if(!$user->is_driver)
        {
            return response(['status' => 'failed', 'message' => 'User should be a restaurant!']);
        }



        $orders = Order::where('status', 4)->where('restaurant_id', $user->restaurant->id)->with('restaurant')->with('user')->get();

        return response(['status' => 'success', 'message' => 'Orders history!', 'orders' => $orders], 200);

    }


}
