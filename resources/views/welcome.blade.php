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


//getLocation();
   
  </script>


@endsection