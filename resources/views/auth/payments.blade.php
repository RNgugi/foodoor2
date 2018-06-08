@extends('layouts.restaurants')



@section('content')
<div style="background: #fbbf67;min-height: 900px;padding-top: 60px;" >
    

<div class="container" style="background: #fff;padding-top: 30px;min-height: 700px;">
    <div class="row">
        <div class="col-md-3">
           @include('partials._profileSidebar')
        </div>

        <div class="col-md-9">
            <h3 style="font-weight: 600;margin-bottom: 30px;">Payments</h3>
            <div class="widget" id="foodoor-cash" style="width: 40%;">
               <div class="widget-body" style="background: #fff;">
                     
                        <h4 style="font-weight: 400;padding-bottom: 0px;margin-bottom: 0px;font-size: 23px;">Foodoor Cash : <span>{{ auth()->user()->wallet_ballance }}</span></h4>
                     
               </div>
            </div> 

            <p><i class="fa fa-info-circle"></i> 10% of your Foodoor money is always reduced in your billing amount. T&amp;C applied.</p>              
        </div>
    </div>
</div>


</div>
@endsection



