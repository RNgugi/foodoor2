@if(auth()->user()->isRestaurant())

<li><a href="{{ '/restaurants-admin' }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href="{{ '/restaurants-admin/orders' }}"><i class="fa fa-file-text"></i> <span>Orders</span></a></li>
<li><a href="{{ '/restaurants-admin/earnings' }}"><i class="fa fa-money"></i> <span>Earnings</span></a></li>
<li><a href="{{ '/restaurants-admin/items' }}"><i class="fa fa-list-ul"></i> <span>Menu Items</span></a></li>
<li><a href="{{ '/restaurants-admin/coupons' }}"><i class="fa fa-qrcode"></i> <span>Offer Coupons</span></a></li>
<li><a href="{{ '/restaurants-admin/freedeliveries' }}"><i class="fa fa-qrcode"></i> <span>Free Delivery Coupons</span></a></li>
<li><a href="/restaurants-admin/restaurants/{{ auth()->user()->restaurant->id}}/edit"><i class="fa fa-user"></i> <span>Manage Restaurant</span></a></li>

@else


<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

<li><a href="{{ backpack_url('earnings') }}"><i class="fa fa-money"></i> <span>Earnings</span></a></li>

<li class="header">Manage Entities</li>

<li><a href="{{ backpack_url('orders') }}"><i class="fa fa-file-text"></i> <span>Orders</span></a></li>

@if(!auth()->user()->isRestaurant())
 <li><a href="{{ backpack_url('restaurants') }}"><i class="fa fa-building"></i> <span>Restaurants</span></a></li>
@endif

<li><a href="{{ backpack_url('items') }}"><i class="fa fa-list-ul"></i> <span>Menu Items</span></a></li>


@if(auth()->user()->isRestaurant())
	<li><a href="/admin/restaurants/{{ auth()->user()->restaurant->id}}/edit"><i class="fa fa-user"></i> <span>Manage Profile</span></a></li>
@endif


@if(!auth()->user()->isRestaurant())
	<li><a href="{{ backpack_url('cuisines') }}"><i class="fa fa-th"></i> <span>Cuisines</span></a></li>


<li><a href="{{ backpack_url('cities') }}"><i class="fa fa-map-marker"></i> <span>Cities</span></a></li>

<li><a href="{{ backpack_url('coupons') }}"><i class="fa fa-qrcode"></i> <span>Offer Coupons</span></a></li>

<li><a href="{{ backpack_url('freedeliveries') }}"><i class="fa fa-qrcode"></i> <span>Free Delivery Coupons</span></a></li>

<li><a href="{{ backpack_url('drivers') }}"><i class="fa fa-motorcycle"></i> <span>Delivery Boys</span></a></li>


<li class="header">General Options</li>
<li><a href="{{ backpack_url('setting') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>

<li class="header">Extras</li>
<li><a href="{{ backpack_url('backup') }}"><i class="fa fa-hdd-o"></i> <span>Backups</span></a></li>

<li><a href="{{ backpack_url('log') }}"><i class="fa fa-terminal"></i> <span>Logs</span></a></li>


<!-- Users, Roles Permissions -->
<li class="treeview">
<a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
</ul>
</li>

@endif

@endif



