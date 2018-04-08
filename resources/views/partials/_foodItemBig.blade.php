<div class="food-item-wrap">
<div class="figure-wrap bg-image" data-image-src="{{ isset($restaurant->logo) ? url($restaurant->logo) : 'http://via.placeholder.com/350x250' }}" style="max-height: 250px;height: 250px;">
    <div class="distance"><i class="fa fa-pin"></i>1240m</div>
    <div class="rating pull-left"> {!! getStars($restaurant->rating) !!}</div>
    
</div>
<div class="content">
    <h5><a href="/restaurants/{{$restaurant->id}}">{{ $restaurant->name }}</a></h5>
    <div class="product-name">{{ $restaurant->area }}</div>
    <div class="price-btn-block"> <span class="price">&#8377  {{ $restaurant->min_price }} <small>/ 2 persons</small></span> <a href="/restaurants/{{$restaurant->id}}" class="btn theme-btn-dash " style="margin-top: 20px;">Order Now</a> </div>
</div>

</div>