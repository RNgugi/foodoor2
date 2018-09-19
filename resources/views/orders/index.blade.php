@extends('layouts.restaurants')

@section('adwords')

<!-- Event snippet for Order Completion conversion page -->;
<script>
gtag('event', 'conversion', {
'send_to': 'AW-792677172/CInOCKv2tokBELSW_fkC',
'transaction_id': ''
});
</script>

@endsection

@section('content')


	<div style="background: #fbbf67;min-height: 900px;padding-top: 60px;padding-bottom: 60px;">

    <div class="container" style="background: #fff;padding-top: 30px;min-height: 700px;">
       <div class="row">
             <div class="col-md-3">
                @include('partials._profileSidebar')
            </div>

            <div class="col-md-9" style="z-index: 0;padding-top: 30px;">
              <div class="">
               <h4 style="font-weight: 600;padding-bottom: 20px;">Past Orders</h4>
             </div>
             @foreach($orders as $order)
               <div class="widget clearfix " style="background: #fff;border: 1px solid #d4d5d9;">
                          <!-- /widget heading -->

                          <div class="widget-body">
                              <div class="col-md-8">
                               <div class="media" style="padding-top: 18px;">
                                <img class="mr-1 hidden-md-down" style="width: 124px;height: 94px;float: left;" src="{{ isset($order->restaurant->logo) ? url($order->restaurant->logo) : 'http://via.placeholder.com/84x84' }}" alt="Generic placeholder image">
                                <div class="media-body">
                                  <h5 class="mt-0" style="font-size: 18px;font-weight: bold;margin-bottom: 1px;">{{ $order->restaurant->name }}</h5>
                                   <p style="font-size: 15px;color: #686b78;margin-bottom: 1px;">{{ $order->restaurant->area }}</p>
                                   <p style="font-size: 15px;color: #686b78;margin-bottom: 3px;">Order #{{$order->id}} | {{ $order->created_at }}</p>
                                   <p style="font-weight: bold;"><a href="/orders/{{$order->id}}">View Details</a></p>
                                </div>
                              </div>
                              </div>
                              <div class="col-md-4">

                              </div>
                              <div class="clearfix"></div>
                          </div>

                  </div>
              @endforeach

              </div>

       </div>
    </div>


  </div>

@endsection
