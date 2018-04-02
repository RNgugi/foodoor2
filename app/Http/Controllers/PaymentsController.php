<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\NewOrderCreated;
use Softon\Indipay\Facades\Indipay;  

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

		  $amount = round($order->total, 2);

           $parameters = [
      
            'tid' => '1233221223322',
            
            'order_id' => '1232212',
            
            'amount' => $amount,
            'purpose' => $orderId,
            'buyer_name' => \Auth::user()->name,
            'email' => \Auth::user()->email,
            'phone' => '9922367414',
            
          ];
 
          
          $purchaseOrder = Indipay::prepare($parameters);

          return Indipay::process($purchaseOrder);
	}

    public function response(Request $request)
    {
        // For default Gateway
        $response = Indipay::response($request);

        $orderId = $response->payment_request->purpose;

        $order = Order::findOrFail($orderId);
        
        if(!$response->success)
        {
        	return redirect('/orders/' . $order->id . '/failed');
        }
        
       
        // $order->status = 1;

        $order->payment_made = 1;

        $order->save();

        $invoice = \PDF::loadView('orders.download', compact('order'));

        $invoiceData = $invoice->output();
        
        $message = new NewOrderCreated($order);

        $message->attachData($invoiceData, 'invoice.pdf', 
                    [
                        'mime' => 'application/pdf',
                    ]);

        \Mail::to($order->user)->send($message);

       //sendSMS('91' . $order->phone, 'Droghers Luggage Travel booking confirmed and scheduled for pickup. Your Booking ID is ' . $booking->id);


        flash('Payment was succesfully made!')->success();

        return redirect('/bookings/' . $order->id);
    }  




}
