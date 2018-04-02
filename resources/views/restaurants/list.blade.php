@extends('layouts.restaurants')

@section('content')
         
         


            <div class="inner-page-hero bg-image" data-image-src="/images/profile-banner.jpg" style="background: url(&quot;images/profile-banner.jpg&quot;) center center / cover no-repeat;">
                <div class="container"> </div>
                <!-- end:Container -->
            </div>


            <div class="result-show">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <p><span class="primary-color"><strong>{{ count($restaurants) }}</strong></span> Results so far </p></div>
                        <p></p>
                        <div class="col-sm-9">
                            <select class="custom-select pull-right">
                                <option selected="">Sort By</option>
                                <option value="1">Distance</option>
                                <option value="2">Delivery Time</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                            <div class="sidebar clearfix m-b-20">
                                <div class="main-block">
                                    <div class="sidebar-title white-txt">
                                        <h6>Choose Cusine</h6> <i class="fa fa-cutlery pull-right"></i> </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control search-field" placeholder="Search your favorite food"> <span class="input-group-btn"> 
                                 <button class="btn btn-secondary search-btn" type="button"><i class="fa fa-search"></i></button> 
                                 </span> </div>
                                    <form>
                                        <ul>
                                          @foreach($cuisines as $cuisine)
                                            <li>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">{{ $cuisine->name }}</span> </label>
                                            </li>
                                          @endforeach  
                                        </ul>
                                    </form>
                                    <div class="clearfix"></div>
                                </div>
                               
                            </div>
                           
                            
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">

                           @foreach($restaurants as $restaurant)
                               <div class="bg-gray restaurant-entry">
                                   <div class="row">
                                       <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                           <div class="entry-logo">
                                               <a class="img-fluid" href="#"><img src="{{ url($restaurant->logo) }}" alt="Food logo"></a>
                                           </div>
                                           <!-- end:Logo -->
                                           <div class="entry-dscr">
                                               <h5><a href="#">{{ $restaurant->name }}</a></h5> <span> @foreach($restaurant->cuisines as $cuisine)
                                             {{ $cuisine->name }},  
                                           @endforeach<a href="#">...</a></span>
                                               <ul class="list-inline">
                                                   <li class="list-inline-item"><i class="fa fa-check"></i> Min $ 10,00</li>
                                                   <li class="list-inline-item"><i class="fa fa-motorcycle"></i> 30 min</li>
                                               </ul>
                                           </div>
                                           <!-- end:Entry description -->
                                       </div>
                                       <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                           <div class="right-content bg-white">
                                               <div class="right-review">
                                                   <div class="rating-block"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                                                   <p> 245 Reviews</p> <a href="/restaurants/{{$restaurant->id}}" class="btn theme-btn-dash">View Menu</a> </div>
                                           </div>
                                           <!-- end:right info -->
                                       </div>
                                   </div>
                                   <!--end:row -->
                               </div>
                           @endforeach 
                            
                        </div>
                    </div>
                </div>
            </section>


@endsection 

