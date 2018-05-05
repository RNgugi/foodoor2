<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Mail\NewOrderMail;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Events\OrderStatusChanged;

class OrdersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $items = \Cart::instance('restaurant-' . request('restaurant_id'))->content();

        $address = [];

        $address['delivery_location'] = request('address');

        $address['lat'] = request('latitude');

        $address['lng'] = request('longitude');

        $address['door_no'] = request('door_no');

        $address['landmark'] = request('landmark');

        $delivery_address = json_encode($address);


        $order = new Order;

        $order->user_id = $user->id;

        $order->restaurant_id = request('restaurant_id');

        $order->delivery_address = $delivery_address;

        $order->subtotal = \Cart::instance('restaurant-' . request('restaurant_id'))->subtotal(2, '.', '');

        $order->tax = \Cart::instance('restaurant-' . request('restaurant_id'))->subtotal(2, '.', '') * (18/100);

        $order->delivery_charges = 30;

        $discount = 0;

        if(request()->has('discount'))
        {
            $discount = request('discount');    
        }  
        
        $order->amount =   $order->subtotal +  $order->tax + $order->delivery_charges - $discount;

        $order->payment_mode = request('payment_mode');

        $order->payment_status = 0;

        $order->save();

        foreach ($items as $key => $item) 
        {
            $customs = $item->options->has('customs') ? $item->options->customs : null;
            $order->items()->attach($item->id, ['qty' => $item->qty, 'price' => $item->price, 'customs' => $customs ]);
        }

        //$order->load('items');

        \Cart::instance('restaurant-' . request('restaurant_id'))->destroy();
        

        if(request('payment_mode') == 1)
        {
            return redirect('/orders/' . $order->id . '/pay');
        } else {
            
            \Mail::to(auth()->user())->send(new OrderPlaced($order));
            
            \Mail::to($order->restaurant->contact_email)->send(new NewOrderMail($order));
            
            $message = 'We have received your order. Waiting for restaurant confirmation!';
            $response = sendSMS(auth()->user()->phone, $message);

            flash('We have received your order and waiting for restaurant confirmation.')->success();
            
            return redirect('/orders/' . $order->id);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm(Order $order)
    {
        $order->status = 1;
        $order->save();

         event(new OrderStatusChanged($order));

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
