<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\Order;
use App\Mail\OrderPlaced;
use App\Mail\NewOrderMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;



class OrdersController extends Controller
{

     public function store() {

        $requestor = request()->user();



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


        $order->user_id = 0;

        $order->user_name  = request('user_name');
        $order->user_phone = request('user_phone');
        $order->user_email  = request('user_email');

        $order->restaurant_id = $requestor->restaurant->id;

        $order->delivery_address = $delivery_address;

        $order->subtotal = request('subtotal');

        $order->tax = request('gst');

        $order->bill_image = request('bill_image');

        $order->delivery_charges =  30;

        $discount = 0;



       $foodoorCash = 0;



        $order->amount =   ceil($order->subtotal +  $order->tax + $order->delivery_charges - $discount - $foodoorCash);

        $order->discounted_price = $discount;

        $order->foodoor_cash = $foodoorCash;

        $order->payment_mode = request('payment_mode');

        $order->payment_status = request('payment_status');

        $order->suggestions = request('suggestions');

        $order->bill_no = request('bill_no');

        $order->order_type = 'OF';

        $order->status = 1;

        $order->save();





           // $drivers = findNearestDrivers($order->restaurant);

           // \Notification::send($drivers, new NewDriverOrder($order));


       //     $invoice = \PDF::loadView('orders.invoice', compact('order'));

           // $invoiceData = $invoice->output();



         //   \Mail::to('foodoor.order@gmail.com')->send(new NewOrderMail($order));

           // \Mail::to($order->restaurant->contact_email)->send(new NewOrderMail($order));

            $message = 'Thanks for ordering with ' . $order->restaurant->name  . '. Your order no: OF'. $order->id . ' and bill amount : Rs. '. $order->amount .'/- .Delivery partner : Foodoor.';

            $response = sendSMS($order->phone, $message);



            $messageToRest = 'You have received a new order of Rs. '. $order->amount .'/-. Order Invoice : https://foodoor.in/orders/'. $order->id  .'/invoice';

            sendSMS($order->restaurant->contact_phone, $messageToRest);


            return response(['status' => 'success', 'message' => 'Order was successfully placed!', 'data' => $order], 200);
        }


        public function storeBill(Order $order)
        {
            $file = request()->file('bill_image');

            $url = '';

            if(!empty($file)) {
               $url = "https://foodoor.in/storage/" . request()->file('bill_image')->store('bills');
            }

            // $order->save();

            return response(['url' => $url], 200);
        }








}
