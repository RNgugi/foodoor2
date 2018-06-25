<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Order;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    public function updateDeviceToken()
    {
    	$user = request()->user();

    	if(!$user)
    	{
    		return response(['status' => 'failed', 'message' => 'User doesn\'t exist!']);
    	}

    	if(!$user->is_driver)
    	{
    		 return response(['status' => 'failed', 'message' => 'User should be delivery boy!']);
    	}

    	$user->driver->device_token = request('device_token');

        $user->driver->save();


    	return response(['status' => 'success', 'message' => 'Device Token Updated!']);

    }

    public function acceptOrder(Order $order)
    {
        $user = request()->user();

        if(!$user)
        {
            return response(['status' => 'failed', 'message' => 'User doesn\'t exist!']);
        }

        if(!$user->is_driver)
        {
            return response(['status' => 'failed', 'message' => 'User should be delivery boy!']);
        }

        if($order->driver_id != 0)
        {
            return response(['status' => 'failed', 'message' => 'The order is already assigned to another delivery boy!']);
        }

        $order->driver_id = $user->driver->id;

        $order->save();

        // send user message;

        return response(['status' => 'success', 'message' => 'Order Accepted!']);
    }


    public function reachedRestaurant(Order $order)
    {
        $user = request()->user();

        if(!$user)
        {
            return response(['status' => 'failed', 'message' => 'User doesn\'t exist!']);
        }

        if(!$user->is_driver)
        {
            return response(['status' => 'failed', 'message' => 'User should be delivery boy!']);
        }

        if($order->driver_id != $user->driver->id)
        {
            return response(['status' => 'failed', 'message' => 'The order is assigned to another delivery boy!']);
        }
        
        $order->driver_reached = 1;

        $order->save();
        
        // send user message;

        return response(['status' => 'success', 'message' => 'Order Status Updated!']);
    }

    public function orderPicked(Order $order)
    {
        $user = request()->user();

        if(!$user)
        {
            return response(['status' => 'failed', 'message' => 'User doesn\'t exist!']);
        }

        if(!$user->is_driver)
        {
            return response(['status' => 'failed', 'message' => 'User should be delivery boy!']);
        }

        if($order->driver_id != $user->driver->id)
        {
            return response(['status' => 'failed', 'message' => 'The order is assigned to another delivery boy!']);
        }
       

        $order->status = 3;
        $order->save();

        event(new OrderStatusChanged($order));
        
        return response(['status' => 'success', 'message' => 'Order Status Updated!']);

    }

    public function orderDelivered(Order $order)
    {
        $user = request()->user();

        if(!$user)
        {
            return response(['status' => 'failed', 'message' => 'User doesn\'t exist!']);
        }

        if(!$user->is_driver)
        {
            return response(['status' => 'failed', 'message' => 'User should be delivery boy!']);
        }

        if($order->driver_id != $user->driver->id)
        {
            return response(['status' => 'failed', 'message' => 'The order is assigned to another delivery boy!']);
        }


        $order->status = 4;
        $order->save();

        event(new OrderStatusChanged($order));

        return response(['status' => 'success', 'message' => 'Order Status Updated!']);
    }

    public function newOrders(Order $order)
    {
        $user = request()->user();

        if(!$user)
        {
            return response(['status' => 'failed', 'message' => 'User doesn\'t exist!']);
        }

        if(!$user->is_driver)
        {
            return response(['status' => 'failed', 'message' => 'User should be delivery boy!']);
        }

        

        $orders = Order::where('status', '<', 4)->where('driver_id', $user->driver->id)->with('restaurant')->with('user')->get();

        return response(['status' => 'success', 'message' => 'Order Status Updated!', 'orders' => $orders], 200);

    }

     public function orderHistory(Order $order)
    {
        $user = request()->user();

        if(!$user)
        {
            return response(['status' => 'failed', 'message' => 'User doesn\'t exist!']);
        }

        if(!$user->is_driver)
        {
            return response(['status' => 'failed', 'message' => 'User should be delivery boy!']);
        }

        

        $orders = Order::where('status', 4)->where('driver_id', $user->driver->id)->with('restaurant')->with('user')->get();

        return response(['status' => 'success', 'message' => 'Order Status Updated!', 'orders' => $orders], 200);

    }

    public function nearest(Restaurant $restaurant)
    {
          return findNearestDrivers($restaurant);  
    }
}
