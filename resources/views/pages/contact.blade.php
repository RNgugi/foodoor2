@extends('layouts.restaurants')


@section('content')
<div style="background: #fbbf67;min-height: 900px;padding-top: 60px;" >
    

<div class="container" style="background: #fff;padding-top: 30px;min-height: 700px;">
    <div class="row">
        <div class="col-md-3">
           @include('pages._sidebar')
        </div>

        <div class="col-md-9">
             <h3 style="font-weight: 600;margin-bottom: 30px;">Contact Us</h3>   

             <p><b style="margin-bottom: 5px;display: block;">Headquaters</b> 1, Nishant apt., Thakkar Nagar <br>
                Sharanpur road, Nashik - 02</p>
             <p style="margin-bottom: 0;"><b>Email : <a href="mailto:contact@foodoor.in">contact@foodoor.in</a></p>

              <p><b>Phone : <a href="tel:9905585412">(+91) 905585412</a></p>

              <br>

              <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:300px;width:500px;'><div id='gmap_canvas' style='height:300px;width:500px;'></div><div><small><a href="embedgooglemaps.com/">https://embedgooglemaps.com/</a></small></div><div><small><a href="http://www.kumo-racing.nl/">newyorkpass</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type='text/javascript'>function init_map(){var myOptions = {zoom:10,center:new google.maps.LatLng(23.2855789,85.30586640000001),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(23.2855789,85.30586640000001)});infowindow = new google.maps.InfoWindow({content:'<strong>Foodoor</strong><br>Hatia, Ranchi, Jharkhand<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
             
        </div>
    </div>
</div>


</div>
@endsection


