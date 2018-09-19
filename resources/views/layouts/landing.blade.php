<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content=" Order food online in Ranchi and get free delivery. Flat 10% off, amazing cashback and sign up bonus" />
    <meta name="keywords" content="restaurants, order food, order online, order food online, food, delivery, food delivery, home delivery,
    fast, hungry, quickly, offer, discount, takeaway, cuisine, pizza, burger, biryani, dessert, juice, dosa, Ranchi, Jaharkhand,
    kareem, Kaveri, Birian, Moti Mahal, Seasons, The Best, Food Factory, Mezbaan, krshna, breakfast, lunch, dinner, snacks,
    restaurants near me">
    <meta name="revisit-after" content="7 days"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="distribution" content="india, global"/>
    <meta name="robots" content="index, follow"/>
    <meta name="googlebot" content="index, follow"/>
      <meta name="language" content="en"/>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1; user-scalable=1;"/>
    <meta name="document-classification" content="internet"/>
    <meta name="document-type" content="public"/>
    <meta name="document-rating" content="safe for kids"/>
    <meta name="generator" content="motive">
    <meta name="author" content="Trumpets Technologies Pvt. Ltd.">

    <link rel="icon" href="/images/fav.png">

    <title>Foodoor - Order Food Online in Ranchi | Use Foodoor10 & Get 10% Off</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/animsition.min.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">

    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-792677172"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'AW-792677172');
    </script>

    @yield('adwords')

  <style type="text/css">
    input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0;
}
  </style>

  @yield('styles')

   <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124203918-1"></script>

    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-124203918-1');
    </script>

   </head>
<body class="home">
    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
         @include('flash::message')
         @include('partials.landing._header')

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


            <!-- Modal -->
            <div class="modal fade" id="bulkOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form method="POST" action="/bulk-orders">
                   @csrf
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fill up the details below and we will get back to you soon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                        <div class="form-group">
                            <label>Name <span style="color: red;">*</span></label>
                            <input type="text" name="name"  class="form-control" placeholder="Enter contact name" required="">
                        </div>
                        <div class="form-group">
                            <label>Phone No. <span style="color: red;">*</span></label>
                            <input type="number" step="1" min="0" name="phone" placeholder="Enter contact number"  class="form-control" required="">
                        </div>
                         <div class="form-group">
                            <label>Event</label>
                            <input type="text"  name="event" placeholder="Tell us about your event"  class="form-control" required="">
                        </div>
                         <div class="form-group">
                            <label>Date <span style="color: red;">*</span></label>
                            <input type="text"   name="eventDate"   class="form-control datepicker" required="">
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



               <!-- Modal -->
            <div class="modal fade" id="restaurantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form method="POST" action="/new-restaurant">
                   @csrf
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fill up the details below and we will get back to you soon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                        <div class="form-group">
                            <label>Name <span style="color: red;">*</span></label>
                            <input type="text" name="name"  class="form-control" placeholder="Enter contact name" required="">
                        </div>
                        <div class="form-group">
                            <label>Phone No. <span style="color: red;">*</span></label>
                            <input type="number" step="1" min="0" name="phone" placeholder="Enter contact number"  class="form-control" required="">
                        </div>
                         <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" placeholder="Enter contact email"  name="email"  class="form-control" required="">
                        </div>
                         <div class="form-group">
                            <label>Address</label>
                            <input type="text"  name="address" placeholder="Where do you reside"  class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" cols="3" name="message" placeholder="Any specific details" required=""></textarea>
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
</script>

  <script>
              $('#flash-overlay-modal').modal();

              $('body').scrollTop(0);
          </script>

        @yield('scripts')
</body>

</html>