<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    	$user->driver->latitude = request('lat');
    	$user->driver->longitude = request('lng');

    	$user->driver->save();


    	return response(['status' => 'success', 'message' => 'Location updated successfully!']);

    }
}
