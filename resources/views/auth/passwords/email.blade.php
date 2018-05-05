@extends('layouts.restaurants')

@section('content')

<div style="background: #e9ecee;">
            <div class="breadcrumb" style="background: #fff;">
               <div class="container">
                  <ul>
                     <li><a href="/" class="active">Home</a></li>
                     <li>Forgot Password</li>
                  </ul>
               </div>
            </div>


            <section class="contact-page inner-page" style="min-height: 900px;">
               <div class="container">
                 <h2 style="font-weight: bold;margin-bottom: 22px;">Send Password Reset E-mail</h2>
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-8">
                        <div class="widget">
                           <div class="widget-body" style="background: #fff;">

                                 @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif   

                          

                           <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="row">
                                    <div class="form-group col-sm-12">
                                       <label for="email">Email address</label>
                                       <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                         @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>    

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 ">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                             </div>

                        </div>
                        
                     </div>
                     
                  </div>

                </div>
                
            </section>      
                           


</div>

@endsection
