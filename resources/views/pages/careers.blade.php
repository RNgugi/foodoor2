@extends('layouts.restaurants')


@section('content')
<div style="background: #fbbf67;min-height: 900px;padding-top: 60px;" >
    

<div class="container" style="background: #fff;padding-top: 30px;min-height: 700px;">
    <div class="row">
        <div class="col-md-3">
           @include('pages._sidebar')
        </div>

        <div class="col-md-9" style="text-align: justify;">
             <h3 style="font-weight: 600;margin-bottom: 30px;">Careers</h3>   

             <p>FooDoor provide online food delivery solutions to end customers. We have started our operations from the capital of Jharkhand, Ranchi and very soon will mark our presence across the state. We are looking for smart, young and dynamic people who can take every problem as a challenge.</p>

 			 <p>Please click the below button to know more about the current openings.</p>   

             <a target="_blank" href="https://goo.gl/forms/Iiyub8ZCnM151lM52" class="btn btn-primary">Be a Part of Foodoor</a>      
        </div>
    </div>
</div>


</div>
@endsection


