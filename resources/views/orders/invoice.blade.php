<!DOCTYPE html>
<html>
<head>
	<title>foodoor-order-{{$order->id}}</title>

	<link href="https://foodoor.in/css/bootstrap.min.css" rel="stylesheet">

	<style type="text/css">
		html body {
		    font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,Sans-serif;
		    background: white;
		    width: 100%;
		    max-width: 800px;
		    min-height: 958px;
		    margin: 30px auto 30px auto;
		}

		.logo img {
			width: 155px;
			height: auto;
			float: right;
		}
	</style>
</head>
<body>

	 <div>

	 	<div class="logo">
	 		<img src="https://foodoor.in/images/logonew2.png">
	 	</div>

	 	<div class="mt-2">

	 		<h3 style="font-weight: bold;">Order no. : #{{$order->id}} 

	 			@if($order->payment_status)
	 			<span style="font-size: 14px;color: green;"> PAID</span>
	 			@else
	 			<span style="font-size: 14px;color: red;" >PAYMENT PENDING</span>
	 			@endif
	 		</h3>
	 		<p>Thanks for choosing Foodoor, {{$order->user->name}}! </p>

	 		<hr>

	 		<div class="row" style="font-size: 15px;">
	 			<div class="col-md-6">
	 				<p>Delivery Details : </p>

	 				<p><b>{{ $order->user->name }}</b> | {{ $order->user->phone }}<br>
                          {{ json_decode($order->delivery_address)->delivery_location }}</p>

	 			</div>

	 			<div class="col-md-6">
	 				<p>Ordered From : </p>

	 				<p><b>{{ $order->restaurant->name }}</b><br>
	 					  {{ $order->restaurant->location }}
                          </p>

	 			</div>

	 			<div class="col-md-12">
	 				<p>Customer Suggestions : </p>
	 				<p>{{$order->suggestions}}</p>
	 			</div>
	 		</div>

	 		
	 		<div class="mt-2">
	 			<table class="table ">

	 			   <thead class="thead-dark">
	 				<tr>
	 					<th>Item Name</th>
	 					<th>Quantity</th>
	 					<th style="text-align: right;">Price</th>
	 				</tr>
	 				</thead>
	 				<tbody>
	 				@foreach($order->items as $item)
	 						 <?php $customs = json_decode($item->pivot->customs, true); 
                                     unset($customs['price']); ?>
                                    <tr>
                                        <td style="font-size: 14px;"> {{ $item->name }} 

                                        		{!! getCustomsString(json_decode($item->pivot->customs)) !!}


                                                
                                                </td>
                                        <td style="font-size: 14px;">{{ $item->pivot->qty }}</td>
                                        <td style="font-size: 14px;text-align: right;">Rs. {{ $item->pivot->price * $item->pivot->qty }}</td>
                                    </tr>



                                @endforeach

                                <tr style="font-size: 14px;text-align: right;"> 
                                                         <td></td>
                                                        <td style="font-size: 14px;">Subtotal</td>
                                                       
                                                        <td style="font-size: 14px;">Rs. {{$order->subtotal }}</td>
                                                    </tr>
                                                    @if($order->foodoor_cash > 0)
                                                    <tr style="text-align: right;">
                                                        <td style="font-size: 14px;"></td>
                                                        <td style="font-size: 14px;">Foodoor Cash</td>
                                                        
                                                        <td style="font-size: 14px;">-Rs. {{ $order->foodoor_cash }}</td>
                                                    </tr>
                                                    @endif
                                                    <tr style="text-align: right;">
                                                        <td style="font-size: 14px;"></td>
                                                        <td style="font-size: 14px;">GST</td>
                                                        
                                                        <td style="font-size: 14px;">Rs. {{ $order->tax }}</td>
                                                    </tr>
                                                    <tr style="text-align: right;">
                                                     <td></td>
                                                        <td style="font-size: 14px;">Delivery Charges</td>
                                                       
                                                        <td style="font-size: 14px;">Rs. {{ $order->delivery_charges}}</td>
                                                    </tr>
                                                    @if($order->discounted_price != NULL)
                                                     <tr style="text-align: right;">
                                                     <td></td>
                                                        <td style="font-size: 14px;">Coupon Discount</td>
                                                       
                                                        <td style="font-size: 14px;">Rs. {{ $order->discounted_price}}</td>
                                                    </tr>
                                                    @endif
                                                   

                                                    <tr style="text-align: right;">
                                                      <td></td>
                                                        <td style="font-size: 14px;" class="text-color"><strong>Total</strong></td>
                                                        
                                                             <td style="font-size: 14px;" class="text-color"><strong>Rs. {{ $order->amount }}</strong></td>
                                                       
                                                    </tr>
                                </tbody>
	 			</table>
	 		</div>
	 	</div>


	 </div>

</body>
</html>