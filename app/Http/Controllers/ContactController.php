<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageEmail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store()
    {
    	  
    	  \Mail::to('waniabhishek47@gmail.com')->send(new ContactMessageEmail(request('name'), request('phone'), request('message'), request('email')));

    	  flash('We have received your details. We will get back to you soon!')->success();

    	  return back();

    }
}
