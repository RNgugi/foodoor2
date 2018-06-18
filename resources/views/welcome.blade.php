@extends('layouts.landing')


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
        
           <div  class="inner-page-hero"  style="background: #2b2b2b;padding-bottom: 19px;
    padding-top: 30px;">


                <div class="container"> 

                <div class="autoplay hidden-sm-down"> 
                  
                    

                      @foreach($allbanners as  $index => $homebanner)
                       <div  class="col-md-3">
                           
                                <a href="{{ $homebanner->url }}" class="">
                                    <img style="width: 100%;height: 270px;" src="{{ url($homebanner->image) }}">
                                 </a>
                            
                           
                       </div>

                     @endforeach  
                     
                       
                   

                </div>

                <div class="autoplay-resp hidden-sm-up"> 
                  
                    

                      @foreach($allbanners as  $index => $homebanner)
                       <div  class="col-md-3">
                           
                                <a href="{{ $homebanner->url }}" class="">
                                    <img style="width: 100%;height: 270px;" src="{{ url($homebanner->image) }}">
                                 </a>
                            
                           
                       </div>

                     @endforeach  
                     
                       
                   

                </div>
               


                </div>
                <!-- end:Container -->
            </div>


            


         @include('partials.landing._locationMatch') 

          <section id="landing" class="hero bg-image" style="padding-top: 56px;
    padding-bottom: 26px;" data-image-src="images/image01.jpg">
            <div class="hero-inner">
                <div class="container text-center hero-text font-white">
                    <h1>Find the best restaurants near you!</h1>
                    <h5 class="font-white space-xs">Currently we serve multi-cuisine food items with huge offers only in Ranchi.</h5>
                    <div class="banner-form">
                        <div class="form-inline">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">Search restaurants...</label>
                              
                                <div class="input-group">
                                    <input style="width: 500px;border-color: #e94e1b;" type="text" class="form-control form-control-lg" id="txtPlaces" placeholder="Enter your delivery location"> 
                                        <i class="fa fa-map-marker hidden-sm-down"  onclick="getLocation()" style="position: relative;right: 22px;top: 14px;font-size: 20px; z-index: 10000;color: #2b2b2b !important;cursor: pointer;" aria-hidden="true"></i>

                                        <i class="fa fa-map-marker hidden-sm-up" onclick="getLocation()" style="position: absolute;right: 7px;top: 7px;font-size: 24px;z-index: 10000;color: #2b2b2b !important;cursor: pointer;" aria-hidden="true"></i>
                                   
                                </div>
                            </div>
                            <button style="margin-left: -20px;" onclick="codeAddress()" type="button" class="btn theme-btn btn-lg">Find Restaurants</button>
                        </div>
                    </div>

                     
                    
                </div>
            </div>
            <!--end:Hero inner -->
        </section>


     {{--     @include('partials.landing._categories')  --}}



        

        <!-- Featured restaurants starts -->
        <section class="featured-restaurants">
            <div class="container">
                 <h2 style="font-weight: bold;margin-bottom: 60px;text-align: center;">Our Exclusive Partners</h2>   
                <!-- restaurants listing starts -->
              <div class="autoplay hidden-sm-down">
                 
                        @foreach($restaurantlogos as $index => $restaurantLogo)
                           @if(isset($restaurantLogo->restaurant))
                               <div class="col-md-3">
                                 
                                    <a href="/restaurants/{{$restaurantLogo->restaurant->id}}?lat={{$restaurantLogo->restaurant->latitude}}&lng={{$restaurantLogo->restaurant->longitude}}" >
                                        <img style="width: 280px;height: 250px;" src="{{ url($restaurantLogo->image) }}">
                                     </a>
                                  
                                   
                               </div>
                           @endif
                       @endforeach

                </div>

                 <div class="autoplay-resp hidden-sm-up">
                 
                        @foreach($restaurantlogos as $index => $restaurantLogo)
                           @if(isset($restaurantLogo->restaurant))
                               <div class="col-md-3">
                                 
                                    <a href="/restaurants/{{$restaurantLogo->restaurant->id}}?lat={{$restaurantLogo->restaurant->latitude}}&lng={{$restaurantLogo->restaurant->longitude}}" >
                                        <img style="width: 280px;height: 250px;" src="{{ url($restaurantLogo->image) }}">
                                     </a>
                                  
                                   
                               </div>
                           @endif
                       @endforeach

                </div>
                <!-- restaurants listing ends -->

             @include('partials._restaurantCta')


             @include('partials._appBanner')

@endsection


@section('scripts')

  <script type="text/javascript">

  function getLocation() {
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(geoSuccess, geoError, {maximumAge:60000, timeout:5000, enableHighAccuracy:true});
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
    }

    function geoSuccess(position) {
          var lat = position.coords.latitude;
          var lng = position.coords.longitude;


          codeLatLng(lat, lng);
      }


      function geoError() {
    alert("There was some problem fetching your location please try again!");
}


function codeLatLng(lat, lng) {
   geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if(status == google.maps.GeocoderStatus.OK) {
          console.log(results)
          if(results[1]) {
              //formatted address
              var address = results[0].formatted_address;
          

              $('#userLocation').html(address);

                var userLocation = { 'lat' : lat, 'lng' : lng, 'address' : address, 'city' :  results[1].long_name};
             

                 localStorage.setItem("userLocation", JSON.stringify(userLocation));

                 location.href = '/restaurants/explore?lat='+ lat + '&lng=' + lng;

          } else {
              alert("No results found");
          }
      } else {
          alert("Geocoder failed due to: " + status);
      }
    });
}

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
