<?php

namespace App\Http\Controllers;

use App\Mail\NewBulkOrder;
use Illuminate\Http\Request;

class BulkOrderController extends Controller
{
    public function store()
    {
    	  
    	  \Mail::to('waniabhishek47@gmail.com')->send(new NewBulkOrder(request('name'), request('phone'), request('message'), request('event'), request('eventDate')));

    	  flash('We have received your details. We will get back to you soon!')->success();

    	  return back();

    }

}
