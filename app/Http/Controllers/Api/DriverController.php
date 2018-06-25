<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
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
}
