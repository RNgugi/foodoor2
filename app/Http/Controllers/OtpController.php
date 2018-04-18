<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtpController extends Controller
{
	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {	
    	$otp = $this->sendOTP();
    	auth()->user()->otp = $otp;
    	auth()->user()->save();
    	return view('auth.phone', compact('otp'));
    }

    public function store()
    {
    	if(auth()->user()->otp == request('otp'))
    	{
    		// success message
    		auth()->user()->is_verified = 1;
    		auth()->user()->save();

    		return redirect('/');

    	} else {
    		// error message
    		return back();
    	}
    }

	public function sendOTP()
    {
        $phone = auth()->user()->phone;

        $otp = mt_rand(10000, 99999);


        $message = 'Your Foodoor verification OTP is ' . $otp;

        $response = sendSMS($phone, $message);

        return $otp;
        //return response(['status' => 'success', 'message' => 'OTP sent successfully!', 'otp' => $otp, 'phone' => $phone, 'api' => $response]);
    }
}
