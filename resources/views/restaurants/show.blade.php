@extends('layouts.restaurants')



@section('content')


            <section class="inner-page-hero sticky-top"  style="background: #171a29;">
               <div class="profile">
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-12  col-md-3 col-lg-4 profile-img">
                           <div class="image-wrap">
                              <figure><img src="{{ url($restaurant->logo) }}" style="height: 160px;" alt="Profile Image"></figure>
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 profile-desc">
                           <div class="pull-left right-text white-txt">
                              <h6><a href="#">{{ $restaurant->name }}</a></h6>
                              <a class="btn btn-small btn-green">Open</a>
                              <p> @foreach($restaurant->cuisines as $cuisine)
                                             {{ $cuisine->name }},  
                                           @endforeach</p>
                              <ul class="nav nav-inline">
                                 <li class="nav-item"> <a class="nav-link active" href="#"><i class="fa fa-check"></i> Min &#8377 {{ $restaurant->min_price }}</a> </li>
                                 <li class="nav-item"> <a class="nav-link" href="#"><i class="fa fa-motorcycle"></i> 30 min</a> </li>
                                 <li class="nav-item ratings">
                                    <a class="nav-link" href="#"> <span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    </span> </a>
                                 </li>
                              </ul>
                           </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-3">
                              <div class="alert alert-success" role="alert" style="margin-top: 40px;">
                              <b><i class="fa fa-percent"></i>  OFFER</b> <br>
                                This is a success alert—check it out!
                              </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>

         

            <div class="breadcrumb" style="background: #fff;">
               <div class="container">
                  <ul>
                     <li><a href="#" class="active">Home</a></li>
                     <li><a href="#">Restaurants</a></li>
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
                              <li><a href="/restaurants/{{ $restaurant->id }}" class="scroll {{ request('cuisine') ==  '' }}">Most Popular</a></li>
                              <li><a href="/restaurants/{{ $restaurant->id }}" class="scroll {{ request('cuisine') ==  '' }}">All Items</a></li>
                              <li><a href="/restaurants/{{ $restaurant->id }}" class="scroll {{ request('cuisine') ==  '' }}">Veg Items</a></li>
                              <li><a href="/restaurants/{{ $restaurant->id }}" class="scroll {{ request('cuisine') ==  '' }}">Non-Veg Items</a></li>
                              @foreach($restaurant->cuisines as $cuisine)
                              <li><a href="/restaurants/{{ $restaurant->id }}?cuisine={{$cuisine->id}}" class="scroll {{ request('cuisine') ==  $cuisine->id ? 'active' : '' }}">{{ $cuisine->name }}</a></li>
                              @endforeach
                           </ul>
                           <div class="clearfix"></div>
                        </div>
                        
                     </div>
                     
                  </div>
                  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                     @foreach($restaurant->cuisines as $cuisine)
                     @if(request('cuisine') == null || $cuisine->id == request('cuisine'))
                     <?php $items = $restaurant->items()->where('cuisine_id', $cuisine->id)->get(); ?>
                     <div class="menu-widget m-b-30">
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
                                 <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info"> <span class="price pull-left">&#8377; {{ $item->price }}</span> <a href="/cart/add/{{$item->id}}" class="btn btn-small btn btn-secondary pull-right">+</a> </div>
                              </div>
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
                        <form method="POST" action="/checkout">
                           @csrf
                           <div class="widget widget-cart">
                              <div class="widget-heading">
                                 <h3 class="widget-title text-dark">
                                    Your Shopping Cart
                                 </h3>
                                 <div class="clearfix"></div>
                              </div>
                              @foreach(Cart::instance('restaurant-'.$restaurant->id)->content() as $item)

                              <div class="order-row bg-white">
                                 <div class="widget-body">
                                    <div class="title-row">{{ $item->name }} <a href="/cart/remove/{{$item->rowId}}/{{$restaurant->id}}"><i class="fa fa-trash pull-right"></i></a></div>
                                    <div class="form-group row no-gutter">
                                      
                                          <input class="form-control" type="number" value="{{ $item->qty }}" id="example-number-input"> 
                                      
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                            
                            
                              <div class="widget-body">
                                 <div class="price-wrap text-xs-center">
                                    <p>SUBTOTAL</p>
                                    <h3 class="value"><strong>&#8377; {{ Cart::instance('restaurant-'.$restaurant->id)->subtotal() }}</strong></h3>
                                    <p>Free Shipping</p>
                                    <button  type="submit" class="btn theme-btn btn-lg">Checkout</button>
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