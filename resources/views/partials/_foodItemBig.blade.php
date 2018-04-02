<div class="food-item-wrap">
<div class="figure-wrap bg-image" data-image-src="{{ url($item->photo) }}" style="max-height: 250px;height: 250px;">
    <div class="distance"><i class="fa fa-pin"></i>1240m</div>
    <div class="rating pull-left"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
    <div class="review pull-right"><a href="#">198 reviews</a> </div>
</div>
<div class="content">
    <h5><a href="profile.html">{{ $item->name }}</a></h5>
    <div class="product-name">{{ $item->description }}</div>
    <div class="price-btn-block"> <span class="price">&#8377  {{ $item->price}}</span> <a href="/restaurants/{{$item->restaurant->id}}" class="btn theme-btn-dash pull-right">Order Now</a> </div>
</div>
<div class="restaurant-block">
    <div class="left">
        <a class="pull-left" href="profile.html"> <img style="height: 50px;width: 60px;" src="{{ url($item->restaurant->logo)}}" alt="Restaurant logo" /> </a>
        <div class="pull-left right-text"> <a href="#">{{ $item->restaurant->name }}</a> <span>{{ $item->restaurant->area}}</span> </div>
    </div>
    <div class="right-like-part pull-right"> <i class="fa fa-heart-o"></i> <span>48</span> </div>
</div>
</div>