@extends('layouts.landing')

@section('content')
        
        @include('partials.landing._hero')

         @include('partials.landing._locationMatch') 


         @include('partials.landing._categories') 



        @include('partials._process')

        <!-- Featured restaurants starts -->
        <section class="featured-restaurants">
            <div class="container">
                
                <!-- restaurants listing starts -->
                <div class="row">

                   

                    <div class="" style="margin-bottom: 20px; margin-top: 80px;" >

                       <img src="/images/hotels/logos.png" style="width: 100%;">
                       
                    </div>
                </div>
                <!-- restaurants listing ends -->

             @include('partials._restaurantCta')


             @include('partials._appBanner')

@endsection