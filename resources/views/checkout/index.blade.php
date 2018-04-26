@extends('layouts.restaurants')


@section('content')
	
    <div style="background: #e9ecee;">
	
    <div class="top-links" style="margin-top: 15px;background: #fff;border-top: 1px solid #ccc;">
                <div class="container">
                    <ul class="row links">
                        <li class="col-xs-12 col-sm-3 link-item active"><span>1</span><a href="/">Choose Your Location</a></li>
                        <li class="col-xs-12 col-sm-3 link-item active"><span>2</span><a href="/restaurants/explore?lat={{$lat}}&lng={{$lng}}">Choose Restaurant</a></li>
                        <li class="col-xs-12 col-sm-3 link-item active"><span>3</span><a href="/restaurants/{{$restaurant->id}}?lat={{$lat}}&lng={{$lng}}">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-3 link-item active"><span>4</span><a href="#">Order and Pay online</a></li>
                    </ul>
                </div>
            </div>


     <div class="container m-t-30" style="min-height: 900px;">
        <form method="POST" action="/orders">
        @csrf
         <h3 style="margin-bottom: 18px; font-weight: 600;">Restaurant : <a href="/restaurants/{{$restaurant->id}}?lat={{$lat}}&lng={{$lng}}">{{ $restaurant->name }}</a></h3>
        <div class="row">
            <div class="col-md-8">

                <div class="widget clearfix" style="background: #fff;">
                    <!-- /widget heading -->
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark" style="font-size: 26px;font-weight: bold;">
                                        Add Delivery Address
                                    </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-body checkout-form">
                        <form method="post" action="#">
                            <div class="row">
                                <div class="col-sm-12 margin-b-30">
                                    
                                   <div class="row"> 
                                      <div class="col-sm-12" >
                                        <div class="form-group">

                                           
                                        </div>
                                       
                                        <div id="us3" style="width: 550px; height: 400px;"></div>
                                        
                                         <div class="">
                                                <input type="text" style="width: 550px;margin-top: 0;padding: 18px;color: #000;font-weight: 500;"  class="form-control" id="address" name="address" />
                                            </div>
                                       
                                            
                                                <input type="hidden" class="form-control" style="width: 110px" id="latitude" name="latitude" />
                                            
                                           

                                                <input type="hidden" class="form-control" style="width: 110px" id="longitude" name="longitude" />
                                           
                                       <div class="clearfix">&nbsp;</div>
                                       
                                    </div>
                                    </div>
                                                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Door No./ Flat No.</label>
                                                <input type="text" name="door_no" class="form-control" placeholder="Ex. Flat no. 1"> </div>
                                            <!--/form-group-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Landmark</label>
                                                <input type="text" name="landmark" class="form-control" placeholder="Nearby place"> </div>
                                            <!--/form-group-->
                                        </div>
                                    </div>
                                   
                                </div>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
            <div class="col-md-4">
                <div class="sidebar-wrap" >
                        
                           <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                           <div class="widget widget-cart" style="background: #fff;">
                              <div class="widget-heading">
                                 <h3 class="widget-title text-dark"  style="font-size: 26px;font-weight: bold;">
                                    Your Shopping Cart
                                 </h3>
                                 <div class="clearfix"></div>
                              </div>
                              @foreach(Cart::instance('restaurant-'.$restaurant->id)->content() as $item)

                              <div class="order-row bg-white">
                                 <div class="widget-body">
                                    <div class="title-row"><span style="font-size: 14px;">{{ $item->name }}</span> 

                                    <p style="font-size:15px;font-weight: bold;margin-top: 2px;margin-left: 3px;" class="pull-right">&#8377; {{ $item->price * $item->qty }}</p>
                                    {{-- <a href="/cart/remove/{{$item->rowId}}/{{$restaurant->id}}">
                                     <i class="fa fa-trash pull-right"></i></a> --}} 

                                    

                                    <div data-trigger="spinner" id="spinner-{{$item->id}}" style="display: inline;text-align: center;float: right;margin-right: 6px;" >
                                      <a style="color: #f30; font-size: 18px;font-weight: bold;
   " href="javascript:;" data-spin="down">-</a>
                                      <input type="text" style="width: 40px;text-align: center;" value="{{ $item->qty }}" data-rule="quantity">
                                      <a href="" style="color: #f30; font-size: 18px;font-weight: bold;" href="javascript:;" data-spin="up">+</a>
                                    </div>
                                    
                                    
                                 </div>
                                    
                                
                              </div>
                              @endforeach

                              <div class="order-row">
                                 <div class="widget-body">
                                  <div class="form-group row no-gutter">
                                   
                                 
                                       <input class="form-control" name="suggestions" style="background: #fcfcfc;color: #000;" type="text" placeholder="Any suggestions?"> 


                                 </div>
                                    
                                    
                                 </div>
                                    
                                
                              </div>

                             
                            
                            
                              <div class="widget-body">
                                <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Cart Summary</h4> </div>
                                        <div class="cart-totals-fields">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Cart Subtotal</td>
                                                        <td>&#8377 {{ Cart::instance('restaurant-'.$restaurant->id)->subtotal() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>GST</td>
                                                        <td>&#8377 {{ floatval(Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', '')) * (5/100) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Delivery Charges</td>
                                                        <td>&#8377 20</td>
                                                    </tr>
                                                    
                                                    @if(session()->has($sessionName))
                                                    <tr>
                                                        <td class="text-color"><strong>Discount</strong></td>
                                                        <td class="text-color"><strong>&#8377 {{$discount}}</strong></td>
                                                    </tr>
                                                    @endif

                                                    <tr>
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        @if(session()->has($sessionName))
                                                             <td class="text-color"><strong>&#8377 {{ floatval(Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', '')) + floatval(Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', '')) * (5/100) + 20 - $discount}}</strong></td>
                                                        @else
                                                             <td class="text-color"><strong>&#8377 {{ floatval(Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', '')) + floatval(Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', '')) * (5/100) + 20 }}</strong></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                     @if(session()->has($sessionName))
                                                        <td colspan="2">
                                                             <div class="alert alert-info" role="alert" style="">
                                                                 <b> COUPON APPLIED : <i class="fa fa-qrcode"></i>  {{ $coupon->code }}</b> <br>
                                                                 {{ $coupon->promo_text }}<br>
                                                                 <a href="javascript:void(0)" style="text-decoration: underline;" onclick="removeCoupon({{ $restaurant->id }})" >Remove Coupon</a>
                                                              </div>
                                                            </td>

                                                     @else   
                                                     <td>
                                                        <input class="form-control" name="coupon_code" id="coupon_code" style="background: #fcfcfc;color: #000;" type="text" placeholder="Coupon Code"> 
                                                      </td>
                                                      <td>  
                                                          <button onclick="applyCoupon({{ $restaurant->id }})" class="btn btn-warning" type="button">Apply Coupon</button>   
                                                       </td>
                                                     @endif     
                                                    </tr>
                                                </tbody>
                                            </table>

                                       
                                
                                        </div>
                                    </div>
                                    <!--cart summary-->
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-20">
                                                    <input id="radioStacked1" value="0" name="payment_mode" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Payment on delivery</span>
                                                    </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="payment_mode" type="radio" value="1" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Pay Online</span><br> <span>Various online payment options like Visa, Mastercard, Rupay, Netbanking, etc. are available.</span>  </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> <button type="submit" class="btn btn-outline-success btn-block">Place Order</button> </p>
                                    </div>
                              </div>
                           </div>
                      
                     </div>
                  </div>
            </div>    

            </div> 
           </form>   
</div>
	

@endsection


@section('scripts')
  
  <script src="/js/jquery.spinner.js"></script>
     <script>

     

    @foreach(Cart::instance('restaurant-'.$restaurant->id)->content() as $item)

     
      $("#spinner-{{$item->id}}")
        .spinner('delay', 200) //delay in ms
        .spinner('changed', function(e, newVal, oldVal) {
          // trigger lazed, depend on delay option.
        })
        .spinner('changing', function(e, newVal, oldVal) {
         if(newVal > oldVal)
         {

          window.location = '/cart/increment/{{$item->rowId}}/{{$restaurant->id}}/newVal:' + newVal
         } else {
             window.location = '/cart/decrement/{{$item->rowId}}/{{$restaurant->id}}/newVal:' + newVal
         }
        });
      @endforeach


                                            $('#us3').locationpicker({
                                                location: {
                                                    latitude: {{ request('lat') }},
                                                    longitude: {{ request('lng') }}
                                                },
                                                radius: 0,
                                                inputBinding: {
                                                    latitudeInput: $('#latitude'),
                                                    longitudeInput: $('#longitude'),
                                                    locationNameInput: $('#address')
                                                },
                                                enableAutocomplete: true,
                                                addressFormat: 'street_address',
                                                onchanged: function (currentLocation, radius, isMarkerDropped) {
                                                    // Uncomment line below to show alert on each Location Changed event
                                                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                                                }
                                            });
                                        </script>


                                        <script type="text/javascript">
                                                
                                                function applyCoupon(restaurantId)
                                                {
                                                    location.href = '/coupons/apply/' + restaurantId + '/coupon:' + $('#coupon_code').val();
                                                }

                                                function removeCoupon(restaurantId)
                                                {
                                                    location.href = '/coupons/apply/' + restaurantId + '/coupon:' + $('#coupon_code').val() + '/remove';
                                                }


                                        </script>


@endsection