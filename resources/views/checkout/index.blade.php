@extends('layouts.restaurants')


@section('content')
	
    <div style="background: #e9ecee;">
	<div class="top-links" style="margin-top: 15px;background: #fff;border-top: 1px solid #ccc;">
                <div class="container">
                    <ul class="row links">
                        <li class="col-xs-12 col-sm-3 link-item active"><span>1</span><a href="index.html">Choose Your Location</a></li>
                        <li class="col-xs-12 col-sm-3 link-item active"><span>2</span><a href="restaurants.html">Choose Restaurant</a></li>
                        <li class="col-xs-12 col-sm-3 link-item active"><span>3</span><a href="/restaurants/{{$restaurant->id}}?lat={{$lat}}&lng={{$lng}}">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-3 link-item"><span>4</span><a href="#">Order and Pay online</a></li>
                    </ul>
                </div>
            </div>


     <div class="container m-t-30" style="min-height: 900px;">
        <div class="row">
            <div class="col-md-8">
                <div class="widget clearfix" style="background: #fff;">
                    <!-- /widget heading -->
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark" style="font-size: 26px;font-weight: bold;">
                                        Add Delivery Details
                                    </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="row">
                                <div class="col-sm-12 margin-b-30">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>First Name *</label>
                                                <input type="text" class="form-control" placeholder="John"> </div>
                                            <!--/form-group-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name *</label>
                                                <input type="text" class="form-control" placeholder="Doe"> </div>
                                            <!--/form-group-->
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Full Address *</label>
                                                <input type="text" class="form-control" placeholder="124, Lorem Street.."> </div>
                                            <!--/form-group-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Door No./ Flat No.</label>
                                                <input type="text" class="form-control" placeholder="Ex. Flat no. 1"> </div>
                                            <!--/form-group-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Pin Code *</label>
                                                <input type="text" class="form-control" placeholder="302012"> </div>
                                            <!--/form-group-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email Address *</label>
                                                <input type="text" class="form-control" placeholder="john@doe.com"> </div>
                                            <!--/form-group-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Phone *</label>
                                                <input type="text" class="form-control" placeholder="123-345-3322"> </div>
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
                        <form method="POST" action="/checkout">
                           @csrf

                           <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                           <input type="hidden" name="lat" value="{{request('lat')}}">
                           <input type="hidden" name="lng" value="{{request('lng')}}">
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
                                    <div class="title-row"><span style="font-size: 14px;">{{ $item->name }}</span> <a href="/cart/remove/{{$item->rowId}}/{{$restaurant->id}}">
                                     <i class="fa fa-trash pull-right"></i></a> <input style="display: inline;width: 40px;text-align: center;float: right;margin-right: 6px;" 
                                    type="number" value="2" id="qty-{{$item->id}}"> 

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
                                                        <td>&#8377 29.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping &amp; Handling</td>
                                                        <td>&#8377 2.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        <td class="text-color"><strong>&#8377 31.00</strong></td>
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
                                                    <input id="radioStacked1" name="radio-stacked" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Payment on delivery</span>
                                                    </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="radio-stacked" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Pay Online</span><br> <span>Various online payment options like Visa, Mastercard, Rupay, Netbanking, etc. are available.</span>  </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> <a href="/checkout/success" class="btn btn-outline-success btn-block">Place Order</a> </p>
                                    </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
            </div>    

            </div>   
</div>
	

@endsection