<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function security()
    {
        return view('auth.security');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function payments()
    {
        return view('auth.payments');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required']);

        auth()->user()->update($request->all());

        flash('Your Profile was updated successfully')->success();


        return back();

    }

    public function updatePassword(Request $request)
    {
          $this->validate($request, [
              'old_password' => 'required',
              'password' => 'required|string|min:6|confirmed'
            ]);
          $old_password = $request->get('old_password');
          $password = $request->get('password');
          if(!\Hash::check($old_password, auth()->user()->password))
          { 
             flash('Please enter your current password correct!')->success();

              return back();
          } 
          
          auth()->user()->password = bcrypt($password);
          auth()->user()->save();
          
          flash('Your password was successfully updated!')->success();

          return back();
    }

    public function updatePhone(Request $request)
    {
        $phone = $request->get('phone');

        auth()->user()->phone = $phone;

        auth()->user()->save();

        return response(['status' => 'success', 'message' => 'Phone updated successfully!'], 200);
    }
}
