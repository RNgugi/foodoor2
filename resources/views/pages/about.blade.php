@extends('layouts.restaurants')


@section('content')
<div style="background: #fbbf67;min-height: 900px;padding-top: 60px;" >
    

<div class="container" style="background: #fff;padding-top: 30px;min-height: 700px;">
    <div class="row">
        <div class="col-md-3">
           @include('pages._sidebar')
        </div>

        <div class="col-md-9">
             <h3 style="font-weight: 600;margin-bottom: 30px;">About Us</h3>   

             <p>We are team FooDoor…….!!</p>
             <p> FooDoor is a platform where user can get delicious food delivered at doorsteps with amazing discounts
              and cashbacks. Also restaurants will be able to expand their horizons and serving locations. It provides a
              single window for ordering food from a wide range of restaurants. We have our own exclusive fleet of
              delivery executives to pick orders from restaurants and deliver it to customers. Our delivery executives
              are native to the place which ensure faster and reliable delivery.</p>
              <p>We are the first in Ranchi, which is providing website along with the android mobile app to order food
              online. FooDoor is starting its operations from the capital of Jharkhand and very soon will mark its
              presence across the state.</p>
              <p>
              We are inspired by the thought of providing a complete food ordering and delivery solution from the
              best neighborhood restaurants to the urban foodie. We embrace innovation, it’s at our core.
              We always put our customer&#39;s need first and always go extra mile for this.</p>         
        </div>
    </div>
</div>


</div>
@endsection


