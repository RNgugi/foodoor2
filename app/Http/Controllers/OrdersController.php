<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Mail\OrderDelivered;
use App\Mail\NewOrderMail;
use App\Models\Order;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Events\OrderStatusChanged;
use App\Notifications\NewDriverOrder;

class OrdersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('invoice');
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

        $sessionName = 'restaurant-' . request('restaurant_id') . '-coupon';

        $user = auth()->user();



        $items = \Cart::instance('restaurant-' . request('restaurant_id'))->content();

        $address = [];

        $address['delivery_location'] = request('address');

        $address['lat'] = request('latitude');

        $address['lng'] = request('longitude');

        $address['door_no'] = request('door_no');

        $address['landmark'] = request('landmark');

        $address['road_name'] = request('road_name');

        $address['alt_mobile'] = request('alt_mobile');

        $delivery_address = json_encode($address);


        $order = new Order;

        $order->user_id = $user->id;

        $order->restaurant_id = request('restaurant_id');

        $order->delivery_address = $delivery_address;

        $order->subtotal = \Cart::instance('restaurant-' . request('restaurant_id'))->subtotal(2, '.', '');



        $order->tax = request('gst');

        $order->delivery_charges = auth()->user()->orders()->count() >= 3 ? 30 : 0;

        $discount = 0;

        if(request()->has('discount'))
        {
            $discount = request('discount');
        }

        $foodoorCash = 0;

        if(request()->has('foodoorcash'))
        {
            $foodoorCash = request('foodoorcash');
        }

        $order->amount =   ceil($order->subtotal +  $order->tax + $order->delivery_charges - $discount - $foodoorCash);

        $order->discounted_price = $discount;

        $order->foodoor_cash = $foodoorCash;

        $order->payment_mode = request('payment_mode');

        $order->payment_status = 0;

        $order->suggestions = request('suggestions');

        $order->save();

        auth()->user()->wallet_ballance = auth()->user()->wallet_ballance - $foodoorCash;

        auth()->user()->save();

        foreach ($items as $key => $item)
        {
            $customs = $item->options->has('customs') ? $item->options->customs : null;
            $order->items()->attach($item->id, ['qty' => $item->qty, 'price' => $item->price, 'customs' => $customs ]);
        }

        //$order->load('items');




        session()->forget($sessionName);


        if(request('payment_mode') == 1)
        {

            $order->flagged = 0;

            $order->save();

            return redirect('/orders/' . $order->id . '/pay');

        } else {

           // $drivers = findNearestDrivers($order->restaurant);

           // \Notification::send($drivers, new NewDriverOrder($order));

            \Cart::instance('restaurant-' . request('restaurant_id'))->destroy();

            $invoice = \PDF::loadView('orders.invoice', compact('order'));

            $invoiceData = $invoice->output();

            $message = new OrderPlaced($order);

            $message->attachData($invoiceData, 'invoice.pdf', [
                            'mime' => 'application/pdf',
                        ]);

            \Mail::to(auth()->user())->send($message);

            \Mail::to('foodoor.order@gmail.com')->send(new NewOrderMail($order));

            \Mail::to($order->restaurant->contact_email)->send(new NewOrderMail($order));

            $message = 'Thanks for ordering with Foodoor. Your order no: '. $order->id . ' and bill amount : Rs. '. $order->amount .'/- . We are waiting for restaurant confirmation and will update you soon.';

            $response = sendSMS(auth()->user()->phone, $message);

            $cashback = ceil($order->subtotal * (5/100)) > 100 ? 100 : ceil($order->subtotal * (5/100));

            auth()->user()->wallet_ballance = auth()->user()->wallet_ballance + $cashback;

            auth()->user()->save();

             $messageToRest = 'You have received a new order of Rs. '. $order->amount .'/-. Order Invoice : https://foodoor.in/orders/'. $order->id  .'/invoice';

            sendSMS($order->restaurant->contact_phone, $messageToRest);

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
    public function invoice(Order $order)
    {
        $invoice = \PDF::loadView('orders.invoice', compact('order'));

        return $invoice->download('invoice.pdf');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ready(Order $order)
    {
        $order->status = 2;
        $order->save();

         event(new OrderStatusChanged($order));

        return back();
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function picked(Order $order)
    {
        $order->status = 3;
        $order->save();

         event(new OrderStatusChanged($order));

        return back();
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delivered(Order $order)
    {
        $order->status = 4;
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
