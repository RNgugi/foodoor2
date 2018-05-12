@component('mail::message')
# New Restaurant Enquiry

You have received a new Restaurant registration enquiry at Foodoor!

### Name : {{ $name }}

### Phone : <a href="tel:{{$phone}}">{{ $phone }}</a>

### Email Address : <a href="mailto:{{$email}}">{{ $email }}</a>

### Address : {{ $address }}

### Message : {{ $message }}

@component('mail::button', ['url' => 'https://foodoor.in'])
Visit Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
