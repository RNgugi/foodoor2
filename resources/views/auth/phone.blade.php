@extends('layouts.restaurants')

@section('styles')

  <style type="text/css">
    input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
  </style>

@endsection

@section('content')
    <div style="background: #e9ecee;">
            <div class="breadcrumb" style="background: #fff;">
               <div class="container">
                  <ul>
                     <li><a href="#" class="active">Home</a></li>
                     <li><a href="#">Account</a></li>
                     <li>Verify</li>
                  </ul>
               </div>
            </div>


            <section class="contact-page inner-page" style="min-height: 900px;">
               <div class="container">
                 
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-4 offset-md-4">
                      <h2 style="font-weight: bold;margin-bottom: 22px;">Enter OTP</h2>
                        <div class="widget">
                           <div class="widget-body" style="background: #fff;">
                              <form method="POST" action="/verify-otp">
                                @csrf
                                 <div class="row">
                                    <div class="form-group col-sm-12">
                                       <input id="otp" type="number" min="1" step="1" class="form-control{{ $errors->has('otp') ? ' is-invalid' : '' }}" name="otp" value="{{ old('otp') }}" required autofocus>

                                         @if ($errors->has('otp'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('otp') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                  
                                  
                                 
                                 </div>

                                 
                                
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <p> <button style="width: 100%;" type="submit" class="btn theme-btn">Verify</button> </p>    

                                       <p>Please enter the 5 digit OTP sent you on +919922367414.</p>
                                       <p> If not received click <a href="/verify-otp">Resend OTP.</a></p> 
                                    </div>
                                 </div>

                                
                              </form>
                           </div>
                           <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                     </div>
                     <!-- WHY? -->
                   
                     <!-- /WHY? -->
                  </div>
               </div>
            </section>
            </div>
            


@endsection
