<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'phone';
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
   {  

    if($request->wantsJson()) {
      if(request('phone') == '')
      {
        return response()->json([
                'status' => 'failed',
                'message' => 'Please enter phone number!'
                
            ]);
      } else if(request('password') == ''){
         return response()->json([
                'status' => 'failed',
                'message' => 'Please enter password!'
                
            ]);
      }
    } else {
      $this->validateLogin($request);
    }

      

     if ($this->attemptLogin($request)) {
           
            $user = $this->guard()->user();
           
            $user->generateToken();
            
            if($request->wantsJson()) {

                $data = $user->toArray();

                

                return response()->json([
                    'status' => 'success',
                    'message' => 'User Logged in successfully!',
                    'data' => $data
                ]);
            }

            return $this->sendLoginResponse($request);
      } 

      if($request->wantsJson()) {
            return response()->json([
                 'status' => 'failed',
                'message' => 'User login failed! Please try again!'
                
            ]);
        }
       return $this->sendFailedLoginResponse($request);
    }


     public function logout(Request $request)
    {
        if($request->wantsJson()) {
        $user = \Auth::guard('api')->user();
        if ($user) {
            $user->api_token = null;
            $user->save();
        }
        return response()->json(['status' => 'success',
                'message' => 'User logged out'], 200);
       } else {
         $this->guard()->logout();
        $request->session()->invalidate();
        return redirect('/');
       }
    }



     /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {

        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }
}
