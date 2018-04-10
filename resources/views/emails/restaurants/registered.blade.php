@component('mail::message')
# Welcome to Foodoor, as the Restaurant Associate.

You are successfully registered as a Restaurant Associate with Foodoor.in. <br><br>

Your account credentials are : 
*Email :* {{ $restaurant->account->email }}
*Password :* password

Use the link below to login to your restaurant admin panel. 

@component('mail::button', ['url' => '/restaurants-admin'])
Manage Restaurant
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
