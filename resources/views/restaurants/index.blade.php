@extends('layouts.restaurants')

@section('content')
        
        @include('partials._hero')

         @include('partials._locationMatch') 


        <section class="popular">
            <div class="container">
                <div class="title text-xs-center m-b-30">
                    <h2>Popular This Month In Your City</h2>
                    <p class="lead">The easiest way to your favourite food</p>
                </div>
                <div class="row">
                    <!-- Each popular food item starts -->
                    @foreach($items as $item)
                       <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                           @include('partials._foodItemBig')
                       </div>
                    @endforeach
                    
                </div>
            </div>
        </section>

        @include('partials._process')

        <!-- Featured restaurants starts -->
        <section class="featured-restaurants">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="title-block pull-left">
                            <h4>Featured restaurants</h4> </div>
                    </div>
                    
                </div>
                <!-- restaurants listing starts -->
                <div class="row">
                    <div class="restaurant-listing">

                        @foreach($restaurants as $restaurant)
                        <div class="col-xs-12 col-sm-12 col-md-6 single-restaurant grill fish thaifood pizza">
                            <div class="restaurant-wrap">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3 col-md-12 col-lg-3 text-xs-center">
                                        <a class="restaurant-logo" href="#"> <img style="height: 90px;width: 110px;" src="{{ url($restaurant->logo) }}" alt="Restaurant logo"> </a>
                                    </div>
                                    <!--end:col -->
                                    <div class="col-xs-12 col-sm-9 col-md-12 col-lg-9">
                                        <h5><a href="/restaurants/{{$restaurant->id}}">{{ $restaurant->name }}</a></h5> <span>
                                           @foreach($restaurant->cuisines as $cuisine)
                                             {{ $cuisine->name }},  
                                           @endforeach
                                        </span>
                                        <div class="bottom-part">
                                            <div class="cost"><i class="fa fa-check"></i> Min &#8377  10,00</div>
                                            <div class="mins"><i class="fa fa-motorcycle"></i> 30 min</div>
                                            <div class="ratings"> <span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </span> (122) </div>
                                        </div>
                                    </div>
                                    <!-- end:col -->
                                </div>
                                <!-- end:row -->
                            </div>
                            <!--end:Restaurant wrap -->
                        </div>
                        @endforeach
                       
                    </div>
                </div>
                <!-- restaurants listing ends -->
            
            @include('partials._restaurantCta')

@endsection