<?php

namespace App\Listeners;

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

            $message = 'Restaurant has confirmed your order. A delivery person will soon reach the restaurant to pickup your order.';
            $response = sendSMS(auth()->user()->phone, $message);

        } elseif($status == 2) {
            $message = 'Your order is ready to leave for delivery.';
            $response = sendSMS(auth()->user()->phone, $message);
        } elseif($status == 3) {
            $message = 'The delivery person has pickep your food for delivery. It will reach you soon. Track your order : https://foodoor.in/orders/' . $event->order->id;
            $response = sendSMS(auth()->user()->phone, $message);
        } elseif($status == 4) {
            $message = 'Your order is delivered to you. Thank you for using Foodoor.';
            $response = sendSMS(auth()->user()->phone, $message);
        }
    }
}
