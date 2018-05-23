<?php

namespace App\Listeners;

use App\Mail\OrderDelivered;
use App\Events\OrderStatusChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderStatusChangedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderStatusChanged  $event
     * @return void
     */
    public function handle(OrderStatusChanged $event)
    {
        $status = $event->order->status;

        if($status == 1) {

            $message = 'Restaurant has confirmed your order. In case of any query please call: 9905585412 .We will notify you once your order will be out for delivery.';
            $response = sendSMS($event->order->user->phone, $message);

        } elseif($status == 2) {
            $message = 'Your order is ready to leave for delivery.';
            $response = sendSMS($event->order->user->phone, $message);
        } elseif($status == 3) {
            $message = 
            'Delivery person is out for delivery and will reach you soon. Request you to keep Rs. '. $event->order->amount .'/- in cash ready. Please ignore if already paid online.'
            $response = sendSMS($event->order->user->phone, $message);
        } elseif($status == 4) {
            $message = 'Your order has been delivered. Congratulations, you have got Foodoor cash of amount Rs. '. ($event->order->amount * (5/100)) .'/-  !!. Use this cash in your next order and save your money.';
            $response = sendSMS($event->order->user->phone, $message);

            \Mail::to($event->order->user)->send(new OrderDelivered($order));
        }
    }
}
