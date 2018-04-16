@extends('layouts.restaurants')

@section('content')
    <div style="background: #e9ecee;">
            <div class="breadcrumb" style="background: #fff;">
               <div class="container">
                  <ul>
                     <li><a href="#" class="active">Home</a></li>
                     <li><a href="#">Account</a></li>
                     <li>Login</li>
                  </ul>
               </div>
            </div>


            <section class="contact-page inner-page" style="min-height: 900px;">
               <div class="container">
                 <h2 style="font-weight: bold;margin-bottom: 22px;">Create New Account</h2>
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-8">
                        <div class="widget">
                           <div class="widget-body" style="background: #fff;">
                              <form method="POST" action="{{ route('register') }}">
                                @csrf
                                 <div class="row">
                                    <div class="form-group col-sm-12">
                                       <label for="name">Full name</label>
                                       <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                         @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-sm-12">
                                       <label for="email">Email address</label>
                                       <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                         @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
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

                                    <div class="form-group col-sm-12">
                                       <label for="password-confirm">Confirm Password</label>
                                       <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                                       @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                  
                                 
                                 </div>

                                 
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <button type="submit" class="btn theme-btn">Create Account</button> </p>     
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


