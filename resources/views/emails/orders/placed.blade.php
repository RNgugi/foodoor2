@extends('layouts.mails')


@section('content')
	 
   

	<div style="background: #e9ecee;">

    <div class="container" style="padding-top: 60px;">

         <div class="widget clearfix " style="background: #fff;z-index: 0;">
                    <!-- /widget heading -->
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark" style="font-size: 26px;font-weight: bold;">
                                        Order #{{$order->id}}
                                    </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-body">
                        @if($order->status >= 3)
                            <h5>Thank you for using Foodoor! Your order is served to you successfully.</h5>
                            <h5>Looking forward to serve you in future.</h5>
                        @else
                            <h5>Thank you for using Foodoor! Your order is being processed and will reach you shortly.</h5>
                            <h5>Looking forward to serve you.</h5>
                        @endif

                        <ul class="progressbar" style="margin-top: 40px;">
                              <li class="{{ $order->status >= 0 ? 'active' : '' }}">order placed</li>
                              <li class="{{ $order->status >= 1 ? 'active' : '' }}">arrived at restaurant</li>
                              <li class="{{ $order->status >= 2 ? 'active' : '' }}">order picked</li>
                              <li class="{{ $order->status >= 3 ? 'active' : '' }}">order served</li>
                      </ul>
                      <div class="clearfix"></div>
                        <h5 style="font-weight: bold;margin-top: 55px;">Delivery Address</h5>
                        <h5>{{ json_decode($order->delivery_address)->delivery_location }}</h5>
                        <h5>{{ json_decode($order->delivery_address)->door_no }} {{ json_decode($order->delivery_address)->landmark }}</h5>

                        
                       <div class="clearfix"></div>
                        <div class="row" style="margin-top: 35px;">
                            <div class="col-sm-8">
                            <h5 style="font-weight: bold;">Restaurant</h5>
                            <h5>{{ $order->restaurant->name }}</h5>
                            </div>
                             @if($order->status < 3)
                            <div class="col-sm-4">
                                <button style="float: right;margin-right: 14px;margin-top: 7px;border-radius: 5px;" type="button" class="btn theme-btn btn-lg"><i class="fa fa-map-marker"></i> Track Your Order</button>
                            </div>
                            @endif
                        </div>
                        <div class="clearfix"></div>

                        <div style="margin-top: 35px;">
                            <table class="table order-table">
                                 <thead class="thead-dark">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->items as $item)

                                    <tr>
                                        <td style="font-size: 18px;">@if($item->is_veg)
                                                 <img src="/images/veg.png" style="width: 12px;height: 12px;margin-top: -2px;" >
                                                @else
                                                <img src="/images/nonveg.png" style="width: 12px;height: 12px;margin-top: -2px;" >
                                                @endif  {{ $item->name }} 

                                                @if(isset($item->pivot->customs))
                                                <br> <span style="font-size: 12px;"> {{ getCustomsString(json_decode($item->pivot->customs, TRUE)) }}</span>
                                                @endif
                                                </td>
                                        <td style="font-size: 18px;">{{ $item->pivot->qty }}</td>
                                        <td style="font-size: 18px;">{{ $item->pivot->price * $item->pivot->qty }}</td>
                                    </tr>



                                @endforeach
                                 <tr style="font-size: 16px;"> 
                                                         <td></td>
                                                        <td style="font-size: 18px;">Subtotal</td>
                                                       
                                                        <td style="font-size: 18px;">&#8377 {{$order->subtotal }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 18px;"></td>
                                                        <td style="font-size: 18px;">GST</td>
                                                        
                                                        <td style="font-size: 18px;">&#8377 {{ $order->subtotal + $order->tax }}</td>
                                                    </tr>
                                                    <tr>
                                                     <td></td>
                                                        <td style="font-size: 18px;">Delivery Charges</td>
                                                       
                                                        <td style="font-size: 18px;">&#8377 {{ $order->delivery_charges}}</td>
                                                    </tr>
                                                    
                                                   

                                                    <tr>
                                                      <td></td>
                                                        <td style="font-size: 18px;" class="text-color"><strong>Total</strong></td>
                                                        
                                                             <td style="font-size: 18px;" class="text-color"><strong>&#8377 {{ $order->amount }}</strong></td>
                                                       
                                                    </tr>
                                </tbody>
                            </table>
                        </div>

                      
                                    <!--cart summary-->
                    </div> 

             </div>            
             </div>
	 </div>  

@endsection