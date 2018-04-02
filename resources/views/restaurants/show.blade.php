@extends('layouts.restaurants')



@section('content')



            <section class="inner-page-hero bg-image" data-image-src="/images/profile-banner.jpg" style="background: url(&quot;/images/profile-banner.jpg&quot;) center center / cover no-repeat;">
               <div class="profile">
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                           <div class="image-wrap">
                              <figure><img src="{{ url($restaurant->logo) }}" style="height: 160px;" alt="Profile Image"></figure>
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                           <div class="pull-left right-text white-txt">
                              <h6><a href="#">{{ $restaurant->name }}</a></h6>
                              <a class="btn btn-small btn-green">Open</a>
                              <p> @foreach($restaurant->cuisines as $cuisine)
                                             {{ $cuisine->name }},  
                                           @endforeach</p>
                              <ul class="nav nav-inline">
                                 <li class="nav-item"> <a class="nav-link active" href="#"><i class="fa fa-check"></i> Min &#8377 10,00</a> </li>
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
                     </div>
                  </div>
               </div>
            </section>


            <div class="breadcrumb">
               <div class="container">
                  <ul>
                     <li><a href="#" class="active">Home</a></li>
                     <li><a href="#">Restaurants</a></li>
                     <li>{{ $restaurant->name }}</li>
                  </ul>
               </div>
            </div>


            <div class="container m-t-30">
               <div class="row">
                  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                     <div class="sidebar clearfix m-b-20">
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
                                       <a class="restaurant-logo pull-left" href="#"><img src="{{ url($item->photo) }}" style="width: 110px;height: 80px;" alt="Food logo"></a>
                                    </div>
                                    <!-- end:Logo -->
                                    <div class="rest-descr">
                                       <h6><a href="#">{{ $item->name }}</a></h6>
                                       <p>{{ $item->description }}</p>
                                    </div>
                                    <!-- end:Description -->
                                 </div>
                                 <!-- end:col -->
                                 <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info"> <span class="price pull-left">&#837; {{ $item->price }}</span> <a href="#" class="btn btn-small btn btn-secondary pull-right">+</a> </div>
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
                        <div class="widget widget-cart">
                           <div class="widget-heading">
                              <h3 class="widget-title text-dark">
                                 Your Shopping Cart
                              </h3>
                              <div class="clearfix"></div>
                           </div>
                           <div class="order-row bg-white">
                              <div class="widget-body">
                                 <div class="title-row">Pizza Quatro Stagione <a href="#"><i class="fa fa-trash pull-right"></i></a></div>
                                 <div class="form-group row no-gutter">
                                   
                                       <input class="form-control" type="number" value="2" id="example-number-input"> 
                                   
                                 </div>
                              </div>
                           </div>
                           <div class="order-row">
                              <div class="widget-body">
                                 <div class="title-row">Carlsberg Beer <a href="#"><i class="fa fa-trash pull-right"></i></a></div>
                                 <div class="form-group row no-gutter">
                                    
                                       <input class="form-control" value="4" id="quant-input"> 
                                    
                                 </div>
                              </div>
                           </div>
                           <!-- end:Order row -->
                         
                           <div class="widget-body">
                              <div class="price-wrap text-xs-center">
                                 <p>TOTAL</p>
                                 <h3 class="value"><strong>&#8377; 25,49</strong></h3>
                                 <p>Free Shipping</p>
                                 <button  type="submit" class="btn theme-btn btn-lg">Checkout</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end:Right Sidebar -->
               </div>
               <!-- end:row -->
            </div>



@endsection