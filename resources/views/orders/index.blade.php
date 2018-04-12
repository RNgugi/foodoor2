@extends('layouts.restaurants')


@section('content')
	 
     <div class="breadcrumb" style="border-top: 1px solid #ccc;margin-top: 13px;">
               <div class="container">
                  <ul>
                     <li><a href="/restaurants" class="active">Home</a></li>
                     <li>My Orders</li>
                  </ul>
               </div>
            </div>  

	<div style="background: #e9ecee;min-height: 900px;">

    <div class="container" style="padding-top: 60px;">
       <h3 style="margin-bottom: 18px; font-weight: 600;">My Orders</a></h3>

       @foreach($orders as $order)
         <div class="widget clearfix " style="background: #fff;z-index: 0;">
                    <!-- /widget heading -->
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark" style="font-size: 26px;font-weight: bold;">
                                        Order #{{$order->id}}
                                    </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-body">
                        <div class="col-md-8">
                          <h5>{{ $order->restaurant->name }}</h5>
                          <h5 style="color: #909090;">{{ $order->restaurant->area }}</h5>
                        </div>
                    </div>

          </div>          
       @endforeach
    </div>


  </div>
  
@endsection
