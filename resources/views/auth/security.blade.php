@extends('layouts.restaurants')



@section('content')
<div style="min-height: 900px;background: #e9ecee;" >
    

<div class="container" style="padding-top: 100px;">
    <div class="row">
        <div class="col-md-3">
           @include('partials._profileSidebar')
        </div>

        <div class="col-md-9">
            <div class="widget">
               <div class="widget-body" style="background: #fff;">
                     <form method="POST" action="/password">
                                @csrf
                                 <div class="row">
                                      <div class="col-sm-12">
                                         <h4 style="font-weight: 600;margin-bottom: 20px;">Account Password</h4>
                                       </div>
                                     <div class="form-group col-sm-12">
                                       <label for="old_password">Old Password</label>
                                       <input id="old_password" type="password"  placeholder="Enter your old password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" name="old_password"  required autofocus>

                                         @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('old_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-sm-12">
                                       <label for="password">New Passowrd</label>

                                       <input id="password" type="password"  placeholder="Enter new password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                         @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                     <div class="form-group col-sm-12">
                                       <label for="password">Confirm New Passowrd</label>

                                       <input id="password_confirmation" type="password"  placeholder="Confirm new password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                                         @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                  
                                 
                                 </div>

                                 
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <button type="submit" class="btn theme-btn">Update Password</button>  </p>     
                                    </div>
                                     
                                 </div>

                                 
                    </form>
               </div>
            </div>               
        </div>
    </div>
</div>


</div>
@endsection



