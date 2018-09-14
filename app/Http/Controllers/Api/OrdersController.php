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

        //$items = json_decode(request('items'));



       /* if(!isset($items) || count($items) == 0)
        {
            return response(['status' => 'failed', 'message' => 'You have no items in the cart!']);
        } */

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

        $user = User::where('phone', request('user_phone'))->orWhere('email', request('user_email'))->first();

        if(!$user)
        {
           $user = User::create(['name' => request('user_name'),
                    'email' => request('user_email'), 'phone' => request('user_phone'), 'password' => Hash::make(config('settings.default_password')),  'is_verified' => 1]);
        }

        $user->phone = request('user_phone');

        $user->save();

        $order->user_id = $user->id;

        $order->restaurant_id = $requestor->restaurant->id;

        $order->delivery_address = $delivery_address;

        $order->subtotal = request('subtotal');

        $order->tax = request('gst');

        $order->bill_image = request('bill_image');

        $order->delivery_charges = $user->orders()->count() >= 3 ? 30 : 0;

        $discount = 0;

       // if(request()->has('discount'))
       // {
       //     $discount = request('discount');
       // }

       $foodoorCash = 0;

       // if(request()->has('foodoorcash'))
       // {
        //    $foodoorCash = request('foodoorcash');
       // }

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

      //  $user->wallet_ballance = $user->wallet_ballance - $foodoorCash;

     //   $user->save();

    //    foreach ($items as $key => $item)
     //   {
    //        $customs = isset($item->customs) ? $item->customs : null;
     //       $order->items()->attach($item->id, ['qty' => $item->qty, 'price' => $item->price, 'customs' => json_encode($customs) ]);
     //   }



           // $drivers = findNearestDrivers($order->restaurant);

           // \Notification::send($drivers, new NewDriverOrder($order));


            $invoice = \PDF::loadView('orders.invoice', compact('order'));

            $invoiceData = $invoice->output();

            $message = new OrderPlaced($order);

            $message->attachData($invoiceData, 'invoice.pdf', [
                            'mime' => 'application/pdf',
                        ]);

            \Mail::to(auth()->user())->send($message);

            \Mail::to('foodoor.order@gmail.com')->send(new NewOrderMail($order));

            \Mail::to($order->restaurant->contact_email)->send(new NewOrderMail($order));

            $message = 'Thanks for ordering with ' . $order->restaurant->name  . '. Your order no: OF'. $order->id . ' and bill amount : Rs. '. $order->amount .'/- .Delivery partner : Foodoor.';

            $response = sendSMS($user->phone, $message);

          //  $cashback = ceil($order->subtotal * (5/100)) > 100 ? 100 : ceil($order->subtotal * (5/100));

          //  $user->wallet_ballance = $user->wallet_ballance + $cashback;

          //  $user->save();

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
