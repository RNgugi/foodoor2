

<div class="food-item-wrap" style="background: #fff;border: none;">

<a href="/restaurants/{{$restaurant->id}}?lat={{request('lat')}}&lng={{request('lng')}}">

	<img src="{{ isset($restaurant->logo) ? url($restaurant->logo) : 'http://via.placeholder.com/350x250' }}" style="max-height: 200px;height: 200px;width: 100%;">
	
	</a>

	<div class="content" style="padding-left: 0;">
	    <h5 style="font-size: 18px;"><a href="/restaurants/{{$restaurant->id}}?lat={{request('lat')}}&lng={{request('lng')}}">{{ $restaurant->name }}</a></h5>
	    <div class="product-name">{{ $restaurant->area }}</div>
	    
	    	<div style="position: relative;margin-top: 5px;font-size: 14px;color: green">
	    	<span style="background: green;color: #fff;padding: 4px;font-size: 12px;"><i class="fa fa-star"></i> {{ number_format($restaurant->rating, 1) }}</span> &nbsp; | &nbsp; <span style="color: grey">{{ $restaurant->delivery_time }}</span> &nbsp; | &nbsp; <span style="color: grey;">&#8377;  {{ $restaurant->min_price }} for two</span></div>
	    
	</div>

</div>

