@extends('layouts.restaurants')

@section('content')
        
        @include('partials._hero')

         @include('partials._locationMatch') 


        <section class="popular">
            <div class="container">
                <div class="title text-xs-center m-b-30">
                    <h2>Our Handpicked Restaurants</h2>
                    <p class="lead">The easiest way to your favourite food</p>
                </div>
                <div class="row">

                   <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">

                     <div class="sidebar clearfix m-b-20">
                        <div class="main-block">
                           <div class="sidebar-title white-txt">
                              <h6>Filter Restaurants</h6>
                              <i class="fa fa-cutlery pull-right"></i> 
                           </div>
                           <ul>
                              <li><a href="javascript(void)" class="scroll {{ request('cuisine') ==  '' }}">Most Popular</a></li>
                              <li><a href="javascript(void)" class="scroll {{ request('cuisine') ==  '' }}">Veg restaurant</a></li>
                              <li><a href="javascript(void)" class="scroll {{ request('cuisine') ==  '' }}">Non Veg Restaurant</a></li>
                              <li><a href="javascript(void)" class="scroll {{ request('cuisine') ==  '' }}">Chinese</a></li>

                               <li><a href="javascript(void)" class="scroll {{ request('cuisine') ==  '' }}">Biryani</a></li>
                              <li><a href="javascript(void)6" class="scroll {{ request('cuisine') ==  '' }}"> All Restaurant</a></li>
                              <li><a href="javascript(void)" class="scroll {{ request('cuisine') ==  '' }}">Near by you</a></li>
                              <li><a href="javascript(void)" class="scroll {{ request('cuisine') ==  '' }}">Price</a></li>

                           </ul>
                           <div class="clearfix"></div>
                        </div>
                        
                     </div>
                     
                  </div>

                  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                    <!-- Each popular food item starts -->
                    @foreach($restaurants as $restaurant)
                       <div class="col-xs-12 col-sm-6 col-md-6 food-item">
                           @include('partials._foodItemBig')
                       </div>
                    @endforeach

                  </div>  
                    
                </div>
            </div>
        </section>

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