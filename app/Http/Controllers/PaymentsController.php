<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\NewOrderCreated;
use Appnings\Payment\Facades\Payment; 

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

		 // $amount = round($order->amount, 2);

      $amount = 1;
           $parameters = [
      
            'tid' => '1233221223322',
            
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

        $orderId = $response->payment_request->order_id;

        $order = Order::findOrFail($orderId);
        
        if(!$response->success)
        {
        	return redirect('/orders/' . $order->id . '/failed');
        }
        
       
        // $order->status = 1;

        $order->payment_status = 1;

        $order->save();

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
