@extends('layouts.restaurants')



@section('content')
<div style="min-height: 900px;background: #e9ecee;" >
    

<div class="container" style="padding-top: 100px;">
    <div class="row">
        <div class="col-md-3">
           @include('partials._profileSidebar')
        </div>

        <div class="col-md-9">
            <div class="widget">
               <div class="widget-body" style="background: #fff;">
                    
                        <h4 style="font-weight: 600;">Foodoor Money : <span>{{ auth()->user()->wallet_ballance }}</span></h4>
                     
               </div>
            </div>               
        </div>
    </div>
</div>


</div>
@endsection



