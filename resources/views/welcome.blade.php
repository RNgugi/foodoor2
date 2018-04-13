@extends('layouts.landing')

@section('content')
        
           <div class="inner-page-hero"  style="background: #ff7726;">
                <div class="container"> 

                  <div class="row">
                     <a href="/restaurants/{{ App\Models\Restaurant::first()->id }}" class="col-md-3">
                        <img style="width: 280px;" src="/images/adv-img-1.jpg">
                     </a>

                     <a  href="/restaurants/{{ App\Models\Restaurant::first()->id }}" class="col-md-3">
                        <img style="width: 280px;" src="/images/adv-img-2.jpg">
                     </a>

                     <a  href="/restaurants/{{ App\Models\Restaurant::first()->id }}" class="col-md-3">
                        <img style="width: 280px;" src="/images/adv-img-3.jpg">
                     </a>

                     <a  href="/restaurants/{{ App\Models\Restaurant::first()->id }}" class="col-md-3">
                        <img style="width: 280px;" src="/images/adv-img-1.jpg">
                     </a>
                  </div>


                </div>
                <!-- end:Container -->
            </div>

         @include('partials.landing._locationMatch') 

          <section id="landing" class="hero bg-image" data-image-src="images/image01.jpg">
            <div class="hero-inner">
                <div class="container text-center hero-text font-white">
                    <h1>Find the best restaurants near you!</h1>
                    <h5 class="font-white space-xs">Find restaurants and order multi-cuisine food items with huge offers</h5>
                    <div class="banner-form">
                        <div class="form-inline">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">Search restaurants...</label>
                              
                                <div class="input-group">
                                    <input style="width: 500px;border-color: #f30;" type="text" class="form-control form-control-lg" id="txtPlaces" placeholder="Enter your delivery location" autofocus="true"> 
                                        <i class="fa fa-map-marker" onclick="getLocation()" style="position: relative;right: 22px;top: 12px;font-size: 24px; z-index: 10000;color: #848282 !important;cursor: pointer;" aria-hidden="true"></i>
                                   
                                </div>
                            </div>
                            <button style="margin-left: -20px;" onclick="codeAddress()" type="button" class="btn theme-btn btn-lg">Find Restaurants</button>
                        </div>
                    </div>

                     
                    
                </div>
            </div>
            <!--end:Hero inner -->
        </section>

        @include('partials._process')

         @include('partials.landing._categories') 



        

        <!-- Featured restaurants starts -->
        <section class="featured-restaurants">
            <div class="container">
                 <h2 style="font-weight: bold;margin-bottom: 40px;text-align: center;">Our Exclusive Partners</h2>   
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