@extends('layouts.restaurants')

@section('content')
    <div style="background: #e9ecee;">
            <div class="breadcrumb" style="background: #fff;">
               <div class="container">
                  <ul>
                     <li><a href="/" class="active">Home</a></li>
                     <li>Login</li>
                  </ul>
               </div>
            </div>


            <section class="contact-page inner-page" style="min-height: 900px;">
               <div class="container">
                 <h2 style="font-weight: bold;margin-bottom: 22px;">Account Login</h2>
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-8">
                        <div class="widget">
                           <div class="widget-body" style="background: #fff;">
                              <form method="POST" action="{{ route('login') }}">
                                @csrf
                                 <div class="row">
                                    <div class="form-group col-sm-12">
                                       <label for="phone">Phone Number</label>
                                       <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                         @if ($errors->has('phone'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                   
                                    <div class="form-group col-sm-12">
                                       <label for="exampleInputPassword1">Password</label>
                                       <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                       @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                  
                                 
                                 </div>

                                  <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <button type="submit" class="btn theme-btn">Sign In</button> 
                                       <a href="/register" class="btn btn-border">Create Account</a> </p>     
                                    </div>
                                     
                                 </div>

                                 <div class="row">
                                     <div class="">
                                         <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                     </div>
                                 </div>
                              </form>
                           </div>
                           <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                     </div>
                     <!-- WHY? -->
                     <div class="col-md-4">
                        
                        <img src="/images/local.png" alt="" class="img-fluid">
                        
                        
                     </div>
                     <!-- /WHY? -->
                  </div>
               </div>
            </section>
            </div>
            


@endsection
