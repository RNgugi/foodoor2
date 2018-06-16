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
	
    <div style="background: #e9ecee;min-height: 1300px;">
	
  


     <div class="container resp-container" style="min-height: 900px;padding-top: 30px;">

        <a style="padding-top: 20px;display: block;padding-bottom: 20px;" href="/restaurants/{{$restaurant->id}}?lat={{request('lat')}}&lng={{request('lng')}}"> <i class="fa fa-arrow-left"></i> Back to Restaurant</a>


        <form id="placeorderform" method="POST" action="/orders">
        @csrf
        
        <div class="row">
            <div class="col-md-8 col-sm-12 hidden-sm-down">

                <div class="widget clearfix" style="background: #fff;">
                    <!-- /widget heading -->
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark" style="font-size: 26px;font-weight: bold;">
                                        Express Checkout
                                    </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-body checkout-form">
                       
                            <div class="row">
                                <div class="col-sm-12 margin-b-30">
                                    
                                   <div class="row"> 
                                      <div class="col-sm-12" >
                                        <div class="form-group">

                                           
                                        </div>
                                       
                                      <div id="us3" class="user-map" style="width: 350px; height: 200px;"></div>
                                        
                                         <div class="">
                                                <input type="text" style="width: 350px;margin-top: 0;padding: 18px;color: #000;font-weight: 500;"  class="form-control user-addr" id="address" name="address" />
                                            </div>
                                       
                                            
                                                <input type="hidden" class="form-control" value="{{ old('latitude') }}" style="width: 110px" id="latitude" name="latitude" />
                                            
                                           

                                                <input type="hidden" class="form-control" value="{{ old('longitude') }}" style="width: 110px" id="longitude" name="longitude" />
                                           
                                       <div class="clearfix">&nbsp;</div>
                                       
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Door No./ Flat No. <span style="color: red;">*</span></label>
                                                <input type="text" name="door_no" value="{{ old('door_no') }}" class="form-control" placeholder="Ex. Flat no. 1" required=""> </div>
                                            <!--/form-group-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Landmark <span style="color: red;">*</span></label>
                                                <input type="text" name="landmark" value="{{ old('landmark') }}" class="form-control" placeholder="Nearby place" required=""> </div>
                                            <!--/form-group-->
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Road Name</label>
                                                <input type="text" name="road_name" value="{{ old('road_name') }}" class="form-control" placeholder="Ex. Thakkar Nagar"> </div>
                                            <!--/form-group-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Alternate Mobile No.</label>
                                                <input id="alt_mobile" onkeyup="checkPhone()" type="number" autocomplete="off"  name="alt_mobile" value="{{ old('alt_mobile') }}" class="form-control" placeholder="Alternate Contact Number" > 
                                                   <span id="alt_mobile_feedback" class="invalid-feedback">
                                                        
                                                   </span>
                                                </div>
                                            <!--/form-group-->
                                        </div>
                                    </div>
                                   
                                </div>
                               
                            </div>
                         <hr>
                           <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-20">
                                                    <input id="radioStacked1" value="0" name="payment_mode" type="radio" class="custom-control-input" required=""> <span class="custom-control-indicator"></span> <span class="custom-control-description">Payment on delivery</span>
                                                    </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="payment_mode" type="radio" value="1" class="custom-control-input" required=""> <span class="custom-control-indicator"></span> <span class="custom-control-description">Pay Online</span><br> <span>Various online payment options like Visa, Mastercard, Rupay, Netbanking, etc. are available.</span>  </label>
                                            </li>
                                        </ul>
                                        @if(session()->has($sessionName) && session($sessionName) != 'foodoorcash')
                                          <input type="hidden" name="discount" value="{{ $discount }}">
                                        @elseif(session()->has($sessionName) && session($sessionName) == 'foodoorcash')  
                                          <input type="hidden" name="foodoorcash" value="{{ $foodoorCash }}">
                                        @endif
                                         @if($subtotal > 99)
                                          <p class="text-xs-center"> <button id="place_order_btn" type="submit" class="btn btn-outline-success btn-block">Place Order</button> </p>
                                         @endif
                                    </div>
                    </div>
                </div>
            </div>  
            <div class="col-md-4 col-sm-12 order-sm-1" >
                <div class="sidebar-wrap" >
                        
                           <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                           <div class="widget widget-cart" style="background: #fff;" id="cart-items">
                             <div class="media" style="padding: 8px;padding-top: 18px;padding-left: 12px;">
                                <img class="mr-1" style="width: 54px;height: 54px;float: left;" src="{{ isset($restaurant->logo) ? url($restaurant->logo) : 'http://via.placeholder.com/64x64' }}" alt="Generic placeholder image">
                                <div class="media-body">
                                  <h5 class="mt-0" style="font-size: 16px;font-weight: bold;">{{ $restaurant->name }}</h5>
                                   <p style="font-size: 14px;color: #b1b1b1;">{{ $restaurant->area }}</p>
                                </div>
                              </div>
                              <div style="max-height: 300px;overflow: scroll;">
                              @foreach(Cart::instance('restaurant-'.$restaurant->id)->content() as $item)
                              <?php $customs = $item->options->has('customs') ? json_decode($item->options->customs, true) : null; ?>
                              <div class="order-row bg-white" style="padding-top: 10px;">
                                 <div class="widget-body" style="padding: 20px;
    padding-bottom: 3px;
    padding-top: 0px;">
                                    <div class="title-row"><span class="item-name" style="font-size: 14px;">@if($item->model->is_veg)
                                                 <img src="/images/veg.png" style="width: 12px;height: 12px;margin-top: -2px;" >
                                                @else
                                                <img src="/images/nonveg.png" style="width: 12px;height: 12px;margin-top: -2px;" >
                                                @endif  {{ $item->name }} <a href="/cart/remove/{{$item->rowId}}/{{$restaurant->id}}"><i class="fa fa-trash"></i></a>  {!! $customs != null ? '<br><small>Customisations : ' .  implode(',', $customs) . '</small>' : '' !!}</span> 
                                    <div style="display: block;margin-bottom: 0;margin-top: 5px;">
                                   
                                    {{-- <a href="/cart/remove/{{$item->rowId}}/{{$restaurant->id}}">
                                     <i class="fa fa-trash pull-right"></i></a> --}} 

                                    

                                    <div data-trigger="spinner" id="spinner-{{$item->rowId}}" style="display: inline;text-align: center;margin-right: 10px;" >
                                      <a style="color: #f30; font-size: 18px;font-weight: bold;
   " href="javascript:;" data-spin="down">-</a>
                                      <input type="text" style="width: 40px;text-align: center;" value="{{ $item->qty }}" data-rule="quantity">
                                      <a href="" style="color: #f30; font-size: 18px;font-weight: bold;" href="javascript:;" data-spin="up">+</a>
                                    </div>

                                     <p style="font-size:15px;margin-top: 2px;margin-left: 3px;display: inline-block;margin-bottom: 0;" >&#8377; {{ $item->price * $item->qty }}</p>
                                    
                                    </div>
                                 </div>
                                    
                                
                              </div>
                              </div>
                              @endforeach
                              </div>
                              <div class="order-row">
                                 <div class="widget-body">
                                  <div class="form-group row no-gutter">
                                   
                                 
                                       <input class="form-control" name="suggestions" value="{{ request('suggestions') }}" style="background: #fcfcfc;color: #000;" type="text" placeholder="Any suggestions?"> 


                                 </div>
                                    
                                    
                                 </div>
                                    
                                
                              </div>

                             
                            
                            
                              <div class="widget-body">
                                <div class="cart-totals margin-b-20">
                                      
                                        <div class="cart-totals-fields">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Cart Subtotal</td>
                                                        <td style="text-align: right;">&#8377;{{ floatval(Cart::instance('restaurant-'.$restaurant->id)->subtotal(2, '.', '')) }}</td>
                                                    </tr>

                                                    @if(session()->has($sessionName) && session($sessionName) == 'foodoorcash' && $foodoorCash > 0)
                                                    <tr>
                                                        <td>Foodoor Cash <a role="button" data-toggle="popover" data-container="body"  data-content="10% of your total foodoor cash is reduced from your billing amount."><i  class="fa fa-info-circle"></i></a></td>
                                                        <td style="text-align: right;">-&#8377;{{ $foodoorCash }}</td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td>GST</td>
                                                        <td style="text-align: right;">&#8377;{{ $gst }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Delivery Charges <a role="button" data-toggle="popover" data-container="body"  data-content="Your first 3 deliveries are on us."><i  class="fa fa-info-circle"></i></a></td>
                                                        <td style="text-align: right;">{{ $deliveryCharge == 0 ? 'FREE' :  $deliveryCharge }}</td>
                                                    </tr>
                                                    
                                                    @if(session()->has($sessionName) && session($sessionName) != 'foodoorcash')
                                                    <tr>
                                                        <td class="text-color"><strong>Order Total</strong></td>
                                                       
                                                             <td style="text-align: right;" class="text-color"><strong>&#8377;{{ $total + $discount }}</strong></td>
                                                     
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Coupon Discount</strong></td>
                                                        <td style="text-align: right;" class="text-color"><strong>-&#8377;{{$discount}}</strong></td>
                                                    </tr>
                                                    @endif

                                                    <tr style="border-top: 1px solid #000;">
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        
                                                        <td style="text-align: right;" class="text-color"><strong>&#8377;{{ $total }}</strong></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                     @if(session()->has($sessionName) && session($sessionName) != 'foodoorcash' )
                                                        <td colspan="2">
                                                             <div class="alert alert-info" role="alert" style="">
                                                                 Congratualtions! Coupon applied successfully. You have saved Rs {{ $discount }}.

                                                                 <a href="javascript:void(0)" style="text-decoration: underline;" onclick="removeCoupon({{ $restaurant->id }})" >Remove Coupon</a>
                                                              </div>
                                                            </td>

                                                     @elseif(session()->has($sessionName) && session($sessionName) == 'foodoorcash') 
                                                      <td colspan="2">
                                                             <div class="alert alert-info" role="alert" style="">
                                                                 Congratualtions! Foodoor cash applied to the bill. You have saved Rs {{ $foodoorCash }}.

                                                                 <a href="javascript:void(0)" style="text-decoration: underline;" onclick="removeCoupon({{ $restaurant->id }})" >Remove Coupon</a>
                                                              </div>
                                                            </td>

                                                     @else  
                                                    
                                                      <td colspan="2">  
                                                          <button data-toggle="modal" data-target="#couponModal" class="btn btn-warning add-coupon-btn" type="button">Apply Coupon</button>   
                                                       </td>
                                                     @endif     
                                                    </tr>
                                                </tbody>
                                            </table>

                                       
                                
                                        </div>
                                    </div>
                                    <!--cart summary-->
                                 
                              </div>
                           </div>
                      
                     </div>
                  </div>

                   <div class="col-md-8 col-sm-12 hidden-sm-up" style="position: relative;
    margin-top: 549px;" id="mobile-checkout">

                <div class="widget" style="background: #fff;">
                    <!-- /widget heading -->
                  
                    <div class="widget-body checkout-form">
                       
                            <div class="row">
                                <div class="col-sm-12 margin-b-30">
                                    
                                   <div class="row"> 
                                      <div class="col-sm-12" >
                                        <div class="form-group">

                                           
                                        </div>
                                       
                                      <div id="us4" class="user-map" style="width: 350px; height: 200px;"></div>
                                        
                                         <div class="">
                                                <input type="text" style="width: 350px;margin-top: 0;padding: 18px;color: #000;font-weight: 500;"  class="form-control user-addr" id="address2" name="address" />
                                            </div>
                                       
                                            
                                                <input type="hidden" class="form-control" value="{{ old('latitude') }}" style="width: 110px" id="latitude2" name="latitude" />
                                            
                                           

                                                <input type="hidden" class="form-control" value="{{ old('longitude') }}" style="width: 110px" id="longitude2" name="longitude" />
                                           
                                       <div class="clearfix">&nbsp;</div>
                                       
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Door No./ Flat No. <span style="color: red;">*</span></label>
                                                <input type="text" name="door_no" value="{{ old('door_no') }}" class="form-control" placeholder="Ex. Flat no. 1" required=""> </div>
                                            <!--/form-group-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Landmark <span style="color: red;">*</span></label>
                                                <input type="text" name="landmark" value="{{ old('landmark') }}" class="form-control" placeholder="Nearby place" required=""> </div>
                                            <!--/form-group-->
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Road Name</label>
                                                <input type="text" name="road_name" value="{{ old('road_name') }}" class="form-control" placeholder="Ex. Thakkar Nagar"> </div>
                                            <!--/form-group-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Alternate Mobile No.</label>
                                                <input id="alt_mobile" onkeyup="checkPhone()" type="number" autocomplete="off"  name="alt_mobile" value="{{ old('alt_mobile') }}" class="form-control" placeholder="Alternate Contact Number" > 
                                                   <span id="alt_mobile_feedback" class="invalid-feedback">
                                                        
                                                   </span>
                                                </div>
                                            <!--/form-group-->
                                        </div>
                                    </div>
                                   
                                </div>
                               
                            </div>
                         <hr>
                           <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-20">
                                                    <input id="radioStacked1" value="0" name="payment_mode" type="radio" class="custom-control-input" required=""> <span class="custom-control-indicator"></span> <span class="custom-control-description">Payment on delivery</span>
                                                    </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="payment_mode" type="radio" value="1" class="custom-control-input" required=""> <span class="custom-control-indicator"></span> <span class="custom-control-description">Pay Online</span><br> <span>Various online payment options like Visa, Mastercard, Rupay, Netbanking, etc. are available.</span>  </label>
                                            </li>
                                        </ul>
                                        @if(session()->has($sessionName) && session($sessionName) != 'foodoorcash')
                                          <input type="hidden" name="discount" value="{{ $discount }}">
                                        @elseif(session()->has($sessionName) && session($sessionName) == 'foodoorcash')  
                                          <input type="hidden" name="foodoorcash" value="{{ $foodoorCash }}">
                                        @endif

                                        @if($subtotal > 99)
                                        <p class="text-xs-center"> <button id="place_order_btn" type="submit" class="btn btn-outline-success btn-block">Place Order</button> </p>
                                        @endif
                                    </div>
                    </div>
                </div>
            </div>   


            </div>    

            </div> 
           </form>   



               <!-- Modal -->
            <div class="modal fade" id="couponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Available Coupons</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      
                      
                     <div class="list-group coupons-list scroll" style="max-height: 400px;
    overflow: scroll;">
                          <div class="list-group-item list-group-item-action">
                           <div>
                            <span class="coupon-code">FOODOOR CASH</span>
                            </div>
                            <div>
                              <p>Pay 10% of your amount from foodoor cash</p>
                            </div>
                            <button type="button" onclick="applyFoodoorCash({{$restaurant->id}})" class="btn btn-outline-success apply-button">Use Foodoor Cash</button>
                          </div>

                          @foreach($coupons as $coupon)
                          <div class="list-group-item list-group-item-action">
                           <div>
                            <span class="coupon-code">{{ $coupon->code }}</span>
                            </div>
                            <div>
                              <p>{{ $coupon->promo_text }}</p>
                            </div>
                            <button type="button" onclick="applyCoupon({{$restaurant->id}}, '{{$coupon->code}}')" class="btn btn-outline-success apply-button">Apply Coupon</button>
                          </div>
                          @endforeach
                        </div>

                      
                      
                        
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
               
                </div>
              </div>
            </div>
</div>
	</div>

@endsection


@section('scripts')
  
  <script src="/js/jquery.spinner.js"></script>
     <script>


     function checkPhone()
     {
         phone = $('#alt_mobile').val();

         if(phone.length == 0)
         {
            $('#place_order_btn').attr('disabled', false);
         } else {
            if(phone.length < 10 || phone.length > 10)
         {
            $('#alt_mobile').addClass('is-invalid');
             $('#alt_mobile_feedback').html('<strong>Please enter a valid phone number.</strong>');

             $('#place_order_btn').attr('disabled', true);

         } else {
               $('#alt_mobile').removeClass('is-invalid');
              $('#alt_mobile_feedback').html('');
              $('#place_order_btn').attr('disabled', false);
         }
         } 

         
     }

     restaurantloc = {'lat' : {{ $restaurant->latitude }}, 'lng' : {{ $restaurant->longitude }} };



     var rad = function(x) {
        return x * Math.PI / 180;
      };

      var getDistance = function(point) {
        var R = 6378137; // Earth’s mean radius in meter
        var dLat = rad(restaurantloc.lat - point.latitude);
        var dLong = rad(restaurantloc.lng - point.longitude);
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
          Math.cos(rad(point.latitude)) * Math.cos(rad(restaurantloc.lat)) *
          Math.sin(dLong / 2) * Math.sin(dLong / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c;
        return d; // returns the distance in meter
      };

     

    @foreach(Cart::instance('restaurant-'.$restaurant->id)->content() as $item)

     
      $("#spinner-{{$item->rowId}}")
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
                                                    if(getDistance(currentLocation) > 2500)
                                                    {
                                                        alert('Sorry, As of now we are not serving in this area.Please choose another location.');

                                                        $('#us3').locationpicker("location", {latitude: {{ request('lat') }}, longitude:{{ request('lng') }} });
                                                    }
                                                }
                                            });

                                             $('#us4').locationpicker({
                                                location: {
                                                    latitude: {{ request('lat') }},
                                                    longitude: {{ request('lng') }}
                                                },
                                                radius: 0,
                                                inputBinding: {
                                                    latitudeInput: $('#latitude2'),
                                                    longitudeInput: $('#longitude2'),
                                                    locationNameInput: $('#address2')
                                                },
                                                enableAutocomplete: true,
                                                addressFormat: 'street_address',
                                                onchanged: function (currentLocation, radius, isMarkerDropped) {
                                                    if(getDistance(currentLocation) > 2500)
                                                    {
                                                        alert('Sorry, As of now we are not serving in this area.Please choose another location.');

                                                        $('#us4').locationpicker("location", {latitude: {{ request('lat') }}, longitude:{{ request('lng') }} });
                                                    }
                                                }
                                            });
                                        </script>


                                        <script type="text/javascript"> 

                                              $('div:hidden input').attr("disabled",true);

                                              var height = $('#cart-items').height() + 40;

                                              console.log(height);

                                              $('#mobile-checkout').css('margin-top',  height);

                                                 function applyFoodoorCash(restaurantId)
                                                {
                                                    location.href = '/coupons/apply/' + restaurantId + '/foodoorcash?' + $('#placeorderform').serialize();
                                                }

                                                
                                                function applyCoupon(restaurantId, code)
                                                {
                                                    location.href = '/coupons/apply/' + restaurantId + '/coupon:' + code + '?' + $('#placeorderform').serialize();
                                                }

                                                function removeCoupon(restaurantId, code)
                                                {
                                                    location.href = '/coupons/apply/' + restaurantId + '/coupon:' + code + '/remove?' + $('#placeorderform').serialize();
                                                }


                                        </script>


@endsection