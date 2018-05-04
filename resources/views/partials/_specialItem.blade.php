

<div class="food-item-wrap" style="background: #fff;border: none;">



	<img src="{{ isset($restaurant->logo) ? url($restaurant->logo) : 'http://via.placeholder.com/350x250' }}" style="max-height: 200px;height: 200px;">
	
	

	<div class="content" style="padding-left: 0;">
	    <h5 style="font-size: 18px;">
	    	@if($item->is_veg)
             <img src="/images/veg.png" style="width: 15px;height: 15px;margin-top: 0px;" >
            @else
            <img src="/images/nonveg.png" style="width: 15px;height: 15px;margin-top: 0px;" >
            @endif 
           {{ $item->name }}</h5>
	    <div class="product-name">{{ $item->description }}</div>
	    
	    	<div style="position: relative;margin-top: 5px;font-size: 14px;color: green">
	    	<span style="background: green;color: #fff;padding: 4px;font-size: 12px;"><i class="fa fa-inr"></i> {{ $item->getPrice() }}</span>

	    	<span>
	    		 <?php $added = Cart::instance('restaurant-'.$restaurant->id)->search(function ($cartItem, $rowId) use ($item)  {
                                          return $cartItem->id === $item->id ;
                                          }); ?>

                                        @if(count($added) && (count($item->additions) == 0 && ($item->sizes == null || count(json_decode($item->sizes)) == 0)))
                                            <div data-trigger="spinner" id="spinner2-{{$item->id}}" style="display: inline;text-align: center;float: right;margin-right: 6px;" >
                                                 <a style="color: #f30; font-size: 18px;font-weight: bold;" href="javascript:;" data-spin="down">-</a>
                                                 <input type="text" style="width: 40px;text-align: center;" min="1" value="{{ $added->first()->qty }}" data-rule="quantity">
                                                 <a href="" style="color: #f30; font-size: 18px;font-weight: bold;" href="javascript:;" data-spin="up">+</a>
                                             </div>
                                          @else
                                             @if(count($item->additions) || ($item->sizes != null && count(json_decode($item->sizes))))
                                                <a href="#toppings-{{$item->id}}" data-toggle="modal" class="btn btn-small btn btn-secondary pull-right">+ Add</a> 
                                             @else
                                                <a href="/cart/add/{{$item->id}}" class="btn btn-small btn btn-secondary pull-right">+ Add</a> 
                                             @endif
                                        @endif
	    	</span>
	    
	</div>

</div>

</div>

 								@if(count($item->additions) || ($item->sizes != null && count(json_decode($item->sizes))))
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