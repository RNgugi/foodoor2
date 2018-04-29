@extends('layouts.restaurants')

@section('content')
         
         


            <div id="#carouselBanners" class="inner-page-hero"  style="background: #c09101;padding-bottom: 19px;
    padding-top: 30px;">


                <div class="container"> 

                <div id="carouselBanners" class="carousel slide" data-ride="carousel">
                   <div class="carousel-inner">
                      @foreach($restaurantbannersChunk as  $index => $restaurantbanners)
                       <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                           <div class="row">

                            @foreach($restaurantbanners as $restaurantbanner)
                                <a href="/restaurants/{{ $restaurantbanner->restaurant->id }}?lat={{ request('lat') }}&lng={{ request('lng') }}" class="col-md-3">
                                    <img style="width: 280px;" src="{{ url($restaurantbanner->image) }}">
                                 </a>
                            @endforeach     
                                
                           </div>
                       </div>
                     @endforeach  
                       
                   </div>
                  
                  <a class="carousel-control-prev" href="#carouselBanners" role="button" data-slide="prev">
                          <i class="fa fa-arrow-left" aria-hidden="true"></i>
                          <span class="sr-only">Previous</span>
                  </a>
                

                  <a class="carousel-control-next" href="#carouselBanners" role="button" data-slide="next">
                           <i class="fa fa-arrow-right" aria-hidden="true"></i>
                           <span class="sr-only">Next</span>
                  </a>
                

                </div>
               


                </div>
                <!-- end:Container -->
            </div>


            <div class="result-show sticky-top" style="background: #fff;">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                          <div class="form-group" style="margin-bottom: 0;">
                                <div class="input-group" style="display: inline;">
                                    <input style="width: 350px;border-color: #f30;" type="text" class="form-control" autofocus="true" id="txtPlaces" placeholder="Enter your location"> 
                                        <i class="fa fa-map-marker" style="position: relative;right: 29px;top: 0px;font-size: 17px; z-index: 10000;color: #848282 !important;" aria-hidden="true"></i>
                                   
                                </div>
                                 <button onclick="codeAddress()" style="display: inline-block;" type="button" class="btn theme-btn">Change Location</button>
                            </div>   
                         </div>
                        <p></p>
                       <!-- <div class="col-sm-4">
                            <select class="custom-select pull-right">
                                <option selected="">Sort By</option>
                                <option value="1">Distance</option>
                                <option value="2">Delivery Time</option>
                            </select>
                        </div> -->
                    </div>
                </div>
            </div>


            <section class="restaurants-page" style="min-height: 1200px;">
                <div class="container">
                    <div class="row">

                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 ">
                     <div class="sidebar clearfix m-b-20 ">
                        <div class="main-block">
                           <div class="sidebar-title white-txt">
                              <h6>Filter Restaurants</h6>
                              <i class="fa fa-cutlery pull-right"></i> 
                           </div>
                           <ul>
                              <li class="{{ request('filter') ==  'all'  ? 'active' : ''  }}"><a href="{{ currentUrl().'&filter=all' }}" class="scroll">All Restaurants</a></li>
                              <li class="{{ request('filter') ==  'popular' ? 'active' : '' }}"><a href="{{ currentUrl().'&filter=popular' }}" class="scroll">Most Popular</a></li>
                              <li class="{{ request('filter') ==  'budget'  ? 'active' : ''  }}"><a href="{{ currentUrl().'&filter=budget' }}" class="scroll">Pocket Friendly</a></li>
                              <li class="{{ request('filter') ==  'veg'  ? 'active' : ''  }}"><a href="{{ currentUrl().'&filter=veg' }}" class="scroll">Pure Veg</a></li>
                              <li class="{{ request('filter') ==  'nonveg'  ? 'active' : ''  }}"><a href="{{ currentUrl().'&filter=nonveg' }}" class="scroll">Non-Veg Special</a></li>

                             
                           </ul>
                           <div class="clearfix"></div>
                        </div>
                        
                     </div>
                     
                  </div>
                      
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                        <?php $restaurantChunks = array_chunk($restaurants, 3); ?>
                        @foreach($restaurantChunks as $restaurants)
                               <div class="row">
                           @foreach($restaurants as $restaurant)
                               <div class="col-sm-4">
                                 @include('partials._foodItemBig')
                               </div>
                              {{--  <div class="bg-gray restaurant-entry">
                                   <div class="row">
                                       <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                           <div class="entry-logo">
                                               <a class="img-fluid" href="#"><img style="height: 120px;" src="{{ isset($restaurant->logo) ? url($restaurant->logo) : 'http://via.placeholder.com/350x250' }}" alt="Food logo"></a>
                                           </div>
                                           <!-- end:Logo -->
                                           <div class="entry-dscr">
                                               <h5><a href="#">{{ $restaurant->name }}</a></h5> <span> @foreach($restaurant->cuisines as $cuisine)
                                             {{ $cuisine->name }},  
                                           @endforeach<a href="#">...</a></span>
                                               <ul class="list-inline">
                                                   <li class="list-inline-item"><i class="fa fa-check"></i> Min &#8377; 350</li>
                                                   <li class="list-inline-item"><i class="fa fa-motorcycle"></i> 30 min</li>
                                               </ul>
                                           </div>
                                           <!-- end:Entry description -->
                                       </div>
                                       <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                           <div class="right-content bg-white">
                                               <div class="right-review">
                                                   <div class="rating-block"> {!! getStars($restaurant->rating) !!} </div>
                                                   <p> 245 Reviews</p> <a href="/restaurants/{{$restaurant->id}}" class="btn theme-btn-dash">View Menu</a> </div>
                                           </div>
                                           <!-- end:right info -->
                                       </div>
                                   </div>
                                   <!--end:row -->
                               </div> --}}
                           @endforeach 
                           </div> 
                         @endforeach  
                            
                        </div>

                      
                    </div>
                </div>
            </section>


@endsection 


@section('scripts')

  
    <script type="text/javascript">
          var userLocation = JSON.parse(localStorage.getItem('userLocation'));

          $('#txtPlaces').val(userLocation.address);


function codeAddress() {
  geocoder = new google.maps.Geocoder();
    var address = document.getElementById('txtPlaces').value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == 'OK') {
      
          var position = results[0].geometry.location
        
          var userLocation = { 'lat' : position.lat(), 'lng' : position.lng(), 'address' : address, 'city' :  results[0].address_components[0].long_name};
           localStorage.setItem("userLocation", JSON.stringify(userLocation));

         location.href = '/restaurants/explore?lat='+ position.lat() + '&lng=' + position.lng();

      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }

    </script>


@endsection

