@component('mail::message')
# New Bulk Order Enquiry

You have received a new bulk order enquiry at Foodoor!

### Name : {{ $name }}

### Phone : <a href="tel:{{$phone}}">{{ $phone }}</a>

### Message : {{ $message }}

@component('mail::button', ['url' => 'https://foodoor.in'])
Visit Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
