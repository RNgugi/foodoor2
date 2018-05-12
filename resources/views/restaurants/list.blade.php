@extends('layouts.restaurants')


@section('styles')
  
  <style type="text/css">
    .carousel-inner .active.left { left: -25%; }


    #carouselBanners .carousel-inner .carousel-item {
  
  /*transition: transform;*/
  transition: all 500ms ease-out; /* transition is added here */
}

#carouselRestaurants .carousel-inner .carousel-item {
  
  /*transition: transform;*/
  transition: all 500ms ease-out; /* transition is added here */
}
  </style>

@endsection


@section('content')
         
         


            <div  class="inner-page-hero hidden-md-down"  style="background: #2b2b2b;padding-bottom: 19px;
    padding-top: 30px;">


                <div class="container"> 

                <div id="carouselBanners" class="carousel slide" data-ride="carousel" data-interval="2000" data-pause="hover"> 
                   <div class="carousel-inner">
                    

                      @foreach($allbanners as  $index => $homebanner)
                       <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                           <div class="col-md-3">
                                <a href="{{ $homebanner->url }}" class="">
                                    <img style="width: 280px;" src="{{ url($homebanner->image) }}">
                                 </a>
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


                         @if($count > $limit)
                         <ul class="pagination">
                    
                          <li class="page-item"><a class="page-link" href="/restaurants/explore?lat={{request('lat')}}&lng={{request('lng')}}&page={{ $page > 1 ? $page-1 : 1}}"><<</a></li>
                           @for($i = 0; $i <= $pages;$i++)
                            <li class="page-item {{ $page == $i+1 ? 'active' : '' }}"><a class="page-link" href="/restaurants/explore?lat={{request('lat')}}&lng={{request('lng')}}&page={{$i+1}}">{{ $i+1 }}</a></li>
                           @endfor
                          <li class="page-item"><a class="page-link" href="/restaurants/explore?lat={{request('lat')}}&lng={{request('lng')}}&page={{ $page <= $pages ? $page+1 : $pages+1}}">>></a></li>
                        </ul>
                        @endif
                            
                        </div>

                      
                    </div>
                </div>
            </section>



           <div class="container">
              <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 ">

                </div>

                 <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                    
                 </div>


              </div>
           </div>


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


    <script type="text/javascript">
    
  $('#carouselBanners').carousel({
  interval: 4000
})

$('#carouselBanners .carousel-item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  for (var i=0;i<2;i++) {
    next=next.next();
    if (!next.length) {
      next = $(this).siblings(':first');
    }

    next.children(':first-child').clone().appendTo($(this));
  }
});

 
  </script>


@endsection

