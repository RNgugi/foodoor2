<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class DriverLocationController extends Controller
{
    public function update()
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

    	$user->driver->lat = request('lat');
    	$user->driver->lng = request('lng');

    	$user->driver->save();
    	

    	return response(['status' => 'success', 'message' => 'Location updated successfully!']);

    }
}
