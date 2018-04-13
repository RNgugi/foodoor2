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

                        <h3 class="widget-title text-dark" style="font-size: 26px;font-weight: bold;float: left;display: inline;width: 50%;">
                            Order #{{$order->id}}
                        </h3>
                        <p style="float: right;color: #000;display: inline-block;color: #8a8a8a;margin-bottom: 0;">{{ $order->created_at->diffForHumans() }}</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-body">
                        <div class="col-md-8">
                          <h5>{{ $order->restaurant->name }}</h5>
                          <h5 style="color: #909090;">{{ $order->restaurant->area }}</h5>
                        </div>
                        <div class="col-md-4">
                          <div style="float: right">
                               <a href="/orders/{{$order->id}}" style="margin-right: 14px;margin-top: 7px;border-radius: 5px;" class="btn btn-warning"><i class="fa fa-file-text"></i> View Details</a>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

          </div>          
       @endforeach
    </div>


  </div>
  
@endsection
