
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <meta name="author" content="">
    <link rel="icon" href="/images/fav.png">
    <title>@yield('title', 'Foodoor | When you think food, Think foodoor')</title>

    <meta name="description" content="@yield('meta-desc')">

    <meta name="keywords" content="@yield('meta-keywords')"><meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

    <meta property="og:type" content="website">

    <meta property="og:description" content="Order food online from restaurants and get it delivered.
      Serving in Bangalore, Hyderabad, Delhi, Gurgaon, Jaipur, Chandigarh, Ahemdabad, Noida, Mumbai, Pune, Kolkata and Chennai.
      Order Pizzas, Burgers, Biryanis, Desserts or order from Subway, Pizza Hut, Dominos, KFC, McDonalds.">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/animsition.min.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">

     <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet"> 

    @yield('styles')


    </head>


<body class="home">

    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
         @include('flash::message')   
         @include('partials._header')
       
         <div class="page-wrapper">
          @yield('content')
         </div>
        

   
        @include('partials._footer')
       
    </div>
    <!--/end:Site wrapper -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/tether.min.js"></script>

    <script src="https://unpkg.com/tooltip.jss"></script>
    <script src="https://unpkg.com/popper.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/animsition.min.js"></script>
    <script src="/js/bootstrap-slider.min.js"></script>
    <script src="/js/jquery.isotope.min.js"></script>
    <script src="/js/headroom.js"></script>
    <script src="/js/foodpicky.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABIlUStLsr84EGUomykEKJeNPIuWbT854&v=3.exp&sensor=false&libraries=places"></script>
        

         

     <script src="/js/locationpicker.jquery.js"></script>
    <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
            google.maps.event.addListener(places, 'place_changed', function () {

            });
        });

           $( function() {
            $( ".datepicker" ).datepicker();
          } );

           $(function () {
  $('[data-toggle="popover"]').popover()
});



                $('.autoplay').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: true
              });

              $('.autoplay-resp').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: true
              });

               $( document ).ready(function() {
                  $('#navbarSideButton').on('click', function() {
                    $('#navbarSide').addClass('reveal');
                    $('.overlay').show();
                    $('.slick-arrow').hide();
                    $('.sticky-top').hide();
                  });

                   // Close navbarSide when the outside of menu is clicked
  $('.overlay').on('click', function(){
    $('#navbarSide').removeClass('reveal');
    $('.overlay').hide();
     $('.slick-arrow').show();
     $('.sticky-top').show();
  });

                });


    </script>


    <script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>

         <!-- Modal -->
            <div class="modal fade" id="bulkOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form method="POST" action="/bulk-orders">
                   @csrf 
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fill up the details below and we will get to you soon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name"  class="form-control" placeholder="Enter contact name" required="">
                        </div>
                        <div class="form-group">
                            <label>Phone No.</label>
                            <input type="number" step="1" min="0" name="phone" placeholder="Enter contact number"  class="form-control" required="">
                        </div>
                         <div class="form-group">
                            <label>Event</label>
                            <input type="text"  name="event" placeholder="Tell us about your event"  class="form-control" required="">
                        </div>
                         <div class="form-group">
                            <label>Date</label>
                            <input type="text"  name="eventDate "   class="form-control datepicker" required="">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" cols="3" name="message" placeholder="Your order purpose/details" required=""></textarea>
                        </div>
                        
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn theme-btn">Send Details</button>
                  </div>
                </form>
                </div>
              </div>
            </div>


            <script>
            $('div.alert-flash').not('.alert-important').delay(3000).fadeOut(350);
            $('.flash-message').delay(3000).fadeOut(350);
            </script>

            <script>
              $('#flash-overlay-modal').modal();
          </script>
        @yield('scripts')
</body>

</html>