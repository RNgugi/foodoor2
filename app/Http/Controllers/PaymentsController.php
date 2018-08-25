<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\NewOrderCreated;
use Appnings\Payment\Facades\Payment; 
use App\Notifications\NewDriverOrder;

class PaymentsController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('response');
    }
    
    public function addMoney(Request $request, Order $order)
	{
		  $orderId = $order->id;

		 $amount = round($order->amount, 2);

     // $amount = 1; for testing
     
           $parameters = [
      
            'tid' => '1001' . $order->id,
            
            'order_id' => $orderId,
            
            'amount' => $amount,
            'billing_name' => \Auth::user()->name,
            'billing_ email' => \Auth::user()->email,
            'billing_ tel' => \Auth::user()->phone,
            'billing_ country' => 'India',

          ];
 
          
          $purchaseOrder = Payment::prepare($parameters);

          return Payment::process($purchaseOrder);
	}

    public function response(Request $request)
    {
        // For default Gateway
        $response = Payment::response($request);

        
        $orderId = $response['order_id'];

        $order = Order::findOrFail($orderId);
        $rid = $order->restaurant->id;
        
        if($response['order_status'] == 'Aborted')
        {
           flash('You cancelled your payment!')->warning();
        	  
             
           $lat = (json_decode($order->delivery_address))->lat;

           $lng = (json_decode($order->delivery_address))->lng;

           $order->delete();

           return redirect('/checkout?restaurant_id=' . $rid . '&lat=' . $lat . '&lng=' . $lng);

        }
        
        \Cart::instance('restaurant-' . $rid)->destroy();
       
        // $order->status = 1;

        $order->payment_status = 1;

         $order->flagged = 1;

        $order->save();

       //  $drivers = findNearestDrivers($order->restaurant);

       //   \Notification::send($drivers, new NewDriverOrder($order));

      /*  $invoice = \PDF::loadView('orders.download', compact('order'));

        $invoiceData = $invoice->output();
        
        $message = new NewOrderCreated($order);

        $message->attachData($invoiceData, 'invoice.pdf', 
                    [
                        'mime' => 'application/pdf',
                    ]);
        */
        //\Mail::to($order->user)->send($message);

       //sendSMS('91' . $order->phone, 'Droghers Luggage Travel booking confirmed and scheduled for pickup. Your Booking ID is ' . $booking->id);


        //flash('Payment was succesfully made!')->success();

         $message = 'Thanks for ordering with Foodoor. Your order no: '. $order->id . ' and bill amount : Rs. '. $order->amount .'/- . We are waiting for restaurant confirmation and will update you soon.';
        $response = sendSMS(auth()->user()->phone, $message);

         $messageToRest = 'You have received a new order of Rs. '. $order->amount .'/-. Order Invoice : https://foodoor.in/orders/'. $order->id  .'/invoice';

            sendSMS($order->restaurant->contact_phone, $messageToRest);

        flash('We have placed your order and waiting for restaurant confirmation.')->success();

        return redirect('/orders/' . $order->id);
    }  




}
