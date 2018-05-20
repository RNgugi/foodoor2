@extends('layouts.restaurants')


@section('content')
<div style="background: #fbbf67;min-height: 900px;padding-top: 60px;" >
    

<div class="container" style="background: #fff;padding-top: 30px;min-height: 700px;">
    <div class="row">
        <div class="col-md-3">
           @include('pages._sidebar')
        </div>

        <div class="col-md-9">
             <h3 style="font-weight: 600;margin-bottom: 30px;">Our Team</h3> 

             <div class="row">
             	<div class="col-md-3">
             		<img src="http://via.placeholder.com/250x250" class="img-thumbnail">
             		<h5 style="margin-top: 7px;margin-bottom: 3px;"><b>Person 1</b></h5>
             		<p >Role of person</p>
             	</div>

             	<div class="col-md-3">
             		<img src="http://via.placeholder.com/250x250" class="img-thumbnail">
             		<h5 style="margin-top: 7px;margin-bottom: 3px;"><b>Person 2</b></h5>
             		<p >Role of person</p>
             	</div>

             	<div class="col-md-3">
             		<img src="http://via.placeholder.com/250x250" class="img-thumbnail">
             		<h5 style="margin-top: 7px;margin-bottom: 3px;"><b>Person 3</b></h5>
             		<p >Role of person</p>
             	</div>

             </div>

             <div style="margin-top: 17px;" class="row">

             	<div class="col-md-3">
             		<img src="http://via.placeholder.com/250x250" class="img-thumbnail">
             		<h5 style="margin-top: 7px;margin-bottom: 3px;"><b>Person 4</b></h5>
             		<p >Role of person</p>
             	</div>

             	<div class="col-md-3">
             		<img src="http://via.placeholder.com/250x250" class="img-thumbnail">
             		<h5 style="margin-top: 7px;margin-bottom: 3px;"><b>Person 5</b></h5>
             		<p >Role of person</p>
             	</div>

             </div>           
        </div>
    </div>
</div>


</div>
@endsection


