<div class="food-item-wrap">
<div class="figure-wrap bg-image" data-image-src="{{ url($restaurant->logo) }}" style="max-height: 250px;height: 250px;">
    <div class="distance"><i class="fa fa-pin"></i>1240m</div>
    <div class="rating pull-left"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
    <div class="review pull-right"><a href="#">198 reviews</a> </div>
</div>
<div class="content">
    <h5><a href="profile.html">{{ $restaurant->name }}</a></h5>
    <div class="product-name">{{ $restaurant->area }}</div>
    <div class="price-btn-block"> <span class="price">&#8377  250 <small>/ 2 persons</small></span> <a href="/restaurants/{{$restaurant->id}}" class="btn theme-btn-dash pull-right">Order Now</a> </div>
</div>

</div>