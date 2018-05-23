@extends('layouts.restaurants')


@section('content')
<div style="background: #fbbf67;min-height: 900px;padding-top: 60px;" >
    

<div class="container" style="background: #fff;padding-top: 30px;min-height: 700px;">
    <div class="row">
        <div class="col-md-3">
           @include('pages._sidebar')
        </div>

        <div class="col-md-9">
             <h3 style="font-weight: 600;margin-bottom: 30px;text-align: left;color: #e94e1b;">Contact Us</h3>   

             <div class="col-md-6">
               <p><b>Contact Info</b></p>

               <p><i class="fa fa-phone"></i> <a href="tel:08102814217">08102814217</a> <a href="tel:08788191787">08788191787</a> <a href="tel:09905585412">09905585412</a></p>

               <p><i class="fa fa-whatsapp"></i> <a href="tel:08788191787">08788191787</a> </p>

               <p><i class="fa fa-envelope"></i> <a href="mailto:contact@foodoor.in">contact@foodoor.in</a> </p>
               <br>
               <div class="mapouter"><div class="gmap_canvas"><iframe width="400" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=Hatia, Ranchi Jharkhand&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><a href="https://www.pureblack.de/webdesign-muenchen/">pure black münchen</a><style>.mapouter{overflow:hidden;height:327px;width:456px;}.gmap_canvas {background:none!important;height:327px;width:456px;}</style></div>
             </div>

             <div class="col-md-6">
               <div class="card" style="background: #f7f7f7;border-radius: 0;">
                 <div class="card-body" style="padding: 16px;">
                  <form method="POST" action="/contact">
                   @csrf
                   <div class="form-group">
                     <label>Name</label>
                     <input type="text" name="name" placeholder="Full name" class="form-control">
                   </div>

                   <div class="form-group">
                     <label>Email</label>
                     <input type="email" name="email" placeholder="Contact Email" class="form-control">
                   </div>

                   <div class="form-group">
                     <label>Phone</label>
                     <input type="text" name="phone" placeholder="Contact number" class="form-control">
                   </div>


                   <div class="form-group">
                     <label>Message</label>
                     <textarea name="message" class="form-control" placeholder="Write something to us.."></textarea>
                   </div>

                   <div class="form-group">
                     <button style="display: block;width: 100%;" type="submit" class="btn btn-success">Submit</button>
                   </div>
                  </form> 
                 </div>
               </div>
             </div>
             
        </div>
    </div>
</div>


</div>
@endsection


