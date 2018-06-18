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
         
         


         

            <div class="result-show sticky-top" style="background: #fff;">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                         <form method="GET" action="/restaurants/search">
                          <div class="form-group" style="margin-bottom: 0;">
                                <div class="input-group" style="display: inline;">
                                    <input style="width: 350px;border-color: #f30;margin-right: 20px;" name="query" value="{{$query}}" type="text" class="form-control" autofocus="true" id="query" placeholder="Enter restaurant name.."> 
                                       
                                   
                                </div>
                                 <button  style="display: inline-block;" type="submit" class="btn theme-btn">Search</button>
                                  <a href="/restaurants/explore?lat={{session('lat')}}&lng={{session('lng')}}"  style="display: inline-block;" class="btn btn-border">Cancel</a>
                            </div>   
                          </form>  
                         </div>
                        <p></p>
                     
                    </div>
                </div>
            </div>


            <section class="restaurants-page" style="min-height: 1200px;">
                <div class="container">
                              
                              @if($query != '')
                                <h3>Showing {{count($restaurants) > 0 ? count($restaurants) : '' }} results for '{{$query}}'..</h3>
                                <hr>
                              @endif

                        
                               <div class="row">
                               @if(count($restaurants) > 0)
                           @foreach($restaurants as $restaurant)
                               <div class="col-sm-3">
                                                                   

                                  <div class="food-item-wrap" style="background: #fff;border: none;">

                                  <a href="/restaurants/{{$restaurant->id}}?lat={{$restaurant->latitude}}&lng={{$restaurant->longitude}}">

                                    <img src="{{ isset($restaurant->logo) ? url($restaurant->logo) : 'http://via.placeholder.com/350x250' }}" style="max-height: 200px;height: 200px;width: 100%;">
                                    
                                    </a>

                                    <div class="content" style="padding-left: 0;">
                                        <h5 style="font-size: 18px;"><a href="/restaurants/{{$restaurant->id}}?lat={{session('lat')}}&lng={{session('lng')}}">{{ $restaurant->name }}</a></h5>
                                        <div class="product-name">{{ $restaurant->area }}</div>
                                        
                                          <div style="position: relative;margin-top: 5px;font-size: 14px;color: green">
                                          <span style="background: green;color: #fff;padding: 4px;font-size: 12px;"><i class="fa fa-star"></i> {{ number_format($restaurant->rating, 1) }}</span> &nbsp; | &nbsp; <span style="color: grey">{{ $restaurant->delivery_time }}</span> &nbsp; | &nbsp; <span style="color: grey;">&#8377;  {{ $restaurant->min_price }} for two</span></div>
                                        
                                    </div>

                                  </div>


                               </div>
                             
                           @endforeach 


                           @else 

                                <div style="text-align: center;" class="mt-2 pt-2">
                                   <img src="/images/empty.png" style="width: 140px;height: 140px;display: block;margin: 0 auto;">
                                   <h2 style="color: grey;">No Results Found!</h2>
                                </div>


                           @endif
                          


                         
                       
                            

                      
                   
                </div>
            </section>



          


@endsection 


@section('scripts')

  
   
@endsection

