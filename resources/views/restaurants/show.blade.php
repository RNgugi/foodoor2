@extends('layouts.restaurants')



@section('content')


            <section class="inner-page-hero"  style="background: #171a29;">
               <div class="profile">
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-12  col-md-3 col-lg-4 profile-img">
                           <div class="image-wrap">
                              <figure><img src="{{ isset($restaurant->logo) ? url($restaurant->logo) : 'http://via.placeholder.com/350x250' }}" style="height: 160px;" alt="Profile Image"></figure>
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 profile-desc">
                           <div class="pull-left right-text white-txt">
                              <h6><a href="#">{{ $restaurant->name }}</a></h6>
                              @if($restaurant->is_open)
                              <a class="btn btn-small btn-green">Open</a>
                              @else
                               <a class="btn btn-small" style="background: red;">Closed</a>
                              @endif
                              <p> @foreach($restaurant->cuisines as $cuisine)
                                             {{ $cuisine->name }},  
                                           @endforeach</p>
                              <ul class="nav nav-inline">
                                 <li class="nav-item"> <a class="nav-link active" href="#"><i class="fa fa-check"></i> Min &#8377 {{ $restaurant->min_price }}</a> </li>
                                 <li class="nav-item"> <a class="nav-link" href="#"><i class="fa fa-motorcycle"></i> {{ $restaurant->delivery_time }}</a> </li>
                                 <li class="nav-item ratings">
                                    <a class="nav-link" href="#"> <span>
                                   {!! getStars($restaurant->rating) !!}
                                    </span> </a>
                                 </li>
                              </ul>
                           </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-3">
                           @if($restaurant->promo_text != '' || $restaurant->promo_text != null)
                            @if(check_in_range($restaurant->valid_from, $restaurant->valid_through, date('Y-m-d')))
                              <div class="alert alert-success" role="alert" style="margin-top: 40px;">
                                 <b>OFFER</b> <br>
                                 {{ $restaurant->promo_text }}
                              </div>
                             @endif
                           @endif   
                        </div>
                     </div>
                  </div>
               </div>
            </section>

         

            <div class="breadcrumb" style="background: #fff;">
               <div class="container">
                  <ul>
                     <li><a href="#" class="active">Home</a></li>
                     <li><a href="/restaurants/explore?lat={{request('lat')}}&lng={{request('lng')}}">Restaurants</a></li>
                     <li>{{ $restaurant->name }}</li>
                  </ul>
               </div>
            </div>

            

            <div class="container m-t-30" style="min-height: 1200px;">
               <div class="row">
                  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 ">
                     <div class="sidebar clearfix m-b-20 ">
                        <div class="main-block">
                           <div class="sidebar-title white-txt">
                              <h6>Choose Cusine</h6>
                              <i class="fa fa-cutlery pull-right"></i> 
                           </div>
                           <ul>
                              
                              <li class="{{ request('filter') == 'all' ? 'active' : '' }}">
                                 <a href="/restaurants/{{ $restaurant->id }}?lat={{request('lat')}}&lng={{request('lng')}}&filter=all" class="scroll">All Items</a>
                              </li>

                              @if(!$restaurant->is_veg)
                                 <li class="{{ request('filter') == 'veg' ? 'active' : '' }}">
                                    <a href="/restaurants/{{ $restaurant->id }}?lat={{request('lat')}}&lng={{request('lng')}}&filter=veg" class="scroll">Veg Items</a>
                                 </li>
                                 
                                 <li class="{{ request('filter') == 'nonveg' ? 'active' : '' }}">
                                    <a href="/restaurants/{{ $restaurant->id }}?lat={{request('lat')}}&lng={{request('lng')}}&filter=nonveg" class="scroll">Non-Veg Items</a>
                                 </li>
                              @endif

                              @foreach($restaurant->cuisines as $cuisine)
                                 <li class="{{ request('cuisine') ==  $cuisine->id ? 'active' : '' }}">
                                    <a href="/restaurants/{{ $restaurant->id }}?lat={{request('lat')}}&lng={{request('lng')}}&cuisine={{$cuisine->id}}" class="scroll">{{ $cuisine->name }}</a>
                                 </li>
                              @endforeach
                          
                           </ul>
                           <div class="clearfix"></div>
                        </div>
                        
                     </div>
                     
                  </div>
                  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">

                     

                        @foreach($restaurant->cuisines as $cuisine)
                           @if(request('cuisine') == null || $cuisine->id == request('cuisine'))
                           @if(request()->has('filter') && request('filter') == 'veg')
                              <?php $items = $restaurant->items()->where('cuisine_id', $cuisine->id)->where('is_veg', 1)->get(); ?>
                           @elseif(request()->has('filter') && request('filter') == 'nonveg')
                              <?php $items = $restaurant->items()->where('cuisine_id', $cuisine->id)->where('is_veg', 0)->get(); ?>
                           @else
                               <?php $items = $restaurant->items()->where('cuisine_id', $cuisine->id)->get(); ?>
                           @endif
                           <div class="menu-widget " style="background: #fff;margin-bottom: 8px;">
                              <div class="widget-heading">
                                 <h3 class="widget-title text-dark">
                                    {{ $cuisine->name }} <a class="btn btn-link pull-right" data-toggle="collapse" href="#cuisine-{{ $cuisine->id }}" aria-expanded="true">
                                    <i class="fa fa-angle-right pull-right"></i>
                                    <i class="fa fa-angle-down pull-right"></i>
                                    </a>
                                 </h3>
                                 <div class="clearfix"></div>
                              </div>
                              <div class="collapse in" id="cuisine-{{ $cuisine->id }}">
                              @foreach($items as $index => $item)
                                 <div class="food-item {{ ($index+1) % 2 == 0 ? 'white' : '' }}">
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-12 col-lg-8">
                                        <div class="rest-logo pull-left">

                                             <a class="restaurant-logo pull-left" href="#">
                                                @if($item->is_veg)
                                                 <img src="/images/veg.png" style="width: 15px;height: 15px;margin-top: 3px;" >
                                                @else
                                                <img src="/images/nonveg.png" style="width: 15px;height: 15px;margin-top: 3px;" >
                                                @endif
                                             </a>
                                          </div> 
                                          
                                          <div class="rest-descr" style="padding-left: 23px;">
                                             <h6><a href="#">{{ $item->name }}</a></h6>
                                             <p>{{ $item->description }}</p>
                                          </div>
                                          <!-- end:Description -->
                                       </div>
                                       <!-- end:col -->
                                       <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info"> <span class="price pull-left">&#8377; {{ $item->price }}</span> 


                                       <?php $added = Cart::instance('restaurant-'.$restaurant->id)->search(function ($cartItem, $rowId) use ($item)  {
                                          return $cartItem->id === $item->id ;
                                          }); ?>

                                          @if(count($added))
                                            <div data-trigger="spinner" id="spinner2-{{$item->id}}" style="display: inline;text-align: center;float: right;margin-right: 6px;" >
                                                 <a style="color: #f30; font-size: 18px;font-weight: bold;" href="javascript:;" data-spin="down">-</a>
                                                 <input type="text" style="width: 40px;text-align: center;" min="1" value="{{ $added->first()->qty }}" data-rule="quantity">
                                                 <a href="" style="color: #f30; font-size: 18px;font-weight: bold;" href="javascript:;" data-spin="up">+</a>
                                             </div>
                                          @else
                                             @if(count($item->additions))
                                                <a href="#toppings-{{$item->id}}" data-toggle="modal" class="btn btn-small btn btn-secondary pull-right">+</a> 
                                             @else
                                                <a href="/cart/add/{{$item->id}}" class="btn btn-small btn btn-secondary pull-right">+</a> 
                                             @endif
                                          @endif

                                       </div>
                                    </div>
                                      @if(count($item->additions) || count(json_decode($item->sizes)))
                                    <div class="modal fade" id="toppings-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <form method="post" action="/cart/add/{{$item->id}}/custom">
                                          @csrf
                                           <div class="modal-content">
                                             <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalCenterTitle" style="font-weight: bold;">{{ $item->name }}</h5>
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                               </button>
                                             </div>
                                             <div class="modal-body">
                                                <h5 style="font-weight: bold;margin-bottom: 18px;">Choose Size</h5>
                                                @foreach(json_decode($item->sizes) as $key => $size)
                                                   <label class="custom-control custom-radio  m-b-20">
                                                          <input id="size" value="{{ $key }}" name="size" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">{{ $size->name }}(&#8377;{{ $size->price }})</span>
                                                          </label>
                                                @endforeach
                                               @foreach($item->additions as $addition)
                                                   <h5 style="font-weight: bold;margin-bottom: 18px;">{{ $addition->name }}</h5>
                                                   @foreach(json_decode($addition->options) as $key => $option)
                                                      @if($addition->select_type == 0)
                                                         <label class="custom-control custom-radio  m-b-20">
                                                          <input id="{{str_slug($option->name)}}" value="{{ $key }}" name="{{str_slug($addition->name)}}" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">{{ $option->name }}(&#8377;{{ $option->price }})</span>
                                                          <br>
                                                          <span>{{ isset($option->description) ? $option->description : '' }}</span>
                                                          </label>
                                                      
                                                      @else
                                                          <label class="custom-control custom-checkbox  m-b-20">
                                                          <input id="{{str_slug($option->name)}}" value="{{ $key }}" name="{{str_slug($addition->name)}}[]" type="checkbox" class="custom-control-input"> <span style="border-radius: 0;" class="custom-control-indicator"></span> <span class="custom-control-description">{{ $option->name }}(&#8377;{{ $option->price }})</span>
                                                          <br>
                                                          <span>{{ isset($option->description) ? $option->description : '' }}</span>
                                                          </label>
                                                      @endif
                                                    @endforeach
                                               @endforeach
                                             </div>
                                             <div class="modal-footer">
                                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                               <button type="submit" class="btn theme-btn">Add to Cart</button>
                                             </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                    @endif
                                    <!-- end:row -->
                                 </div>
                          @endforeach

                          
                           </div>
                           </div>
                          @endif
                     @endforeach


                     
                     
                  </div>
                  <!-- end:Bar -->
                  <div class="col-xs-12 col-md-12 col-lg-3">
                     <div class="sidebar-wrap">
                        <form method="GET" action="/checkout">
                          

                           <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                            <input type="hidden" name="lat" value="{{request('lat')}}">
                             <input type="hidden" name="lng" value="{{request('lng')}}">
                           <div class="widget widget-cart" style="background: #fff;">
                              <div class="widget-heading">
                                 <h3 style="font-weight: bold;font-size: 24px;" class="widget-title text-dark">
                                    Cart <br>   <small style="color: #8a8a8a;font-size: 15px;">{{ Cart::instance('restaurant-'.$restaurant->id)->count() }} items</small>
                                 </h3>

                                 <div class="clearfix"></div>
                              </div>
                              @foreach(Cart::instance('restaurant-'.$restaurant->id)->content() as $item)

                              <div class="order-row bg-white">
                                 <div class="widget-body">
                                    <div class="title-row"><span style="font-size: 14px;">  
                                             @if($item->model->is_veg)
                                                 <img src="/images/veg.png" style="width: 12px;height: 12px;margin-top: -2px;" >
                                                @else
                                                <img src="/images/nonveg.png" style="width: 12px;height: 12px;margin-top: -2px;" >
                                                @endif {{ $item->name }}</span> 

                                    <p style="font-size:12px;font-weight: normal;margin-top: 2px;margin-left: 3px;" class="pull-right">&#8377; {{ $item->price * $item->qty }} 
                                             <a href="/cart/remove/{{$item->rowId}}/{{$restaurant->id}}"><i class="fa fa-trash"></i></a></p>
                                    {{-- <a href="/cart/remove/{{$item->rowId}}/{{$restaurant->id}}">
                                     <i class="fa fa-trash pull-right"></i></a> --}} 

                                    

                                    <div data-trigger="spinner" id="spinner-{{$item->id}}" style="display: inline;text-align: center;float: right;margin-right: 6px;" >
                                      <a style="color: #f30; font-size: 18px;font-weight: bold;
   " href="javascript:;" data-spin="down">-</a>
                                      <input type="text" style="width: 40px;text-align: center;" min="1" value="{{ $item->qty }}" data-rule="quantity">
                                      <a href="" style="color: #f30; font-size: 18px;font-weight: bold;" href="javascript:;" data-spin="up">+</a>
                                    </div>

                                     </div>
                                    
                                    
                                 </div>
                                    
                                
                              </div>
                              @endforeach

                              <div class="order-row">
                                 <div class="widget-body">
                                  <div class="form-group row no-gutter">
                                   
                                 
                                       <input class="form-control" name="suggestions" style="background: #fcfcfc;color: #000;" type="text" placeholder="Any suggestions?"> 
                                
                                 </div>
                                    
                                    
                                 </div>
                                    
                                
                              </div>
                            
                            
                              <div class="widget-body">
                                 <div class="price-wrap text-xs-center">
                                    <p>SUBTOTAL</p>
                                    <h3 class="value"><strong>&#8377; {{ Cart::instance('restaurant-'.$restaurant->id)->subtotal() }}</strong></h3>
                                    <p  style="color: #8a8a8a;font-size: 14px;">Extra charges may apply</p>
                                    <button style="width: 100%;" type="submit" class="btn theme-btn btn-lg" {{  $restaurant->is_open ? '' : 'disabled'}}>Checkout</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <!-- end:Right Sidebar -->
               </div>
               <!-- end:row -->
            </div>



@endsection


@section('scripts')


   <script src="/js/jquery.spinner.js"></script>

    @foreach(Cart::instance('restaurant-'.$restaurant->id)->content() as $item)

      <script>
      $("#spinner-{{$item->id}}")
        .spinner('delay', 200) //delay in ms
        .spinner('changed', function(e, newVal, oldVal) {
          // trigger lazed, depend on delay option.
        })
        .spinner('changing', function(e, newVal, oldVal) {
         if(newVal > oldVal)
         {

          window.location = '/cart/increment/{{$item->rowId}}/{{$restaurant->id}}/newVal:' + newVal
         } else {
             window.location = '/cart/decrement/{{$item->rowId}}/{{$restaurant->id}}/newVal:' + newVal
         }
        });
      </script>

       <script>
      $("#spinner2-{{$item->id}}")
        .spinner('delay', 200) //delay in ms
        .spinner('changed', function(e, newVal, oldVal) {
          // trigger lazed, depend on delay option.
        })
        .spinner('changing', function(e, newVal, oldVal) {
         if(newVal > oldVal)
         {

         window.location = '/cart/increment/{{$item->rowId}}/{{$restaurant->id}}/newVal:' + newVal
         } else {
              window.location = '/cart/decrement/{{$item->rowId}}/{{$restaurant->id}}/newVal:' + newVal
         }
        });
      </script>

    @endforeach
   

@endsection