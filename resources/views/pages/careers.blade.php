@extends('layouts.restaurants')


@section('content')
<div style="background: #fbbf67;min-height: 900px;padding-top: 60px;" >
    

<div class="container" style="background: #fff;padding-top: 30px;min-height: 700px;">
    <div class="row">
        <div class="col-md-3">
           @include('pages._sidebar')
        </div>

        <div class="col-md-9">
             <h3 style="font-weight: 600;margin-bottom: 30px;">Careers</h3>   

             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
             quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
             consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
             proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>   

             <a target="_blank" href="https://goo.gl/forms/Iiyub8ZCnM151lM52" class="btn btn-primary">Be a Part of Foodoor</a>      
        </div>
    </div>
</div>


</div>
@endsection


