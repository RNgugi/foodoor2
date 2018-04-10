@component('mail::message')
# Welcome to Foodoor, as the Delivery Associate.

You are successfully registered as a Delivery Associate with Foodoor.in. <br><br>

Your account credentials are : 
*Email :* {{ $driver->user->email }}
*Password :* password

Use the link below to download the delivery boy app and start earning with us. 

@component('mail::button', ['url' => ''])
Download App
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
