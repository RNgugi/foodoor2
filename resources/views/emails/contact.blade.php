@component('mail::message')
# New Contact Form Message

You have received a new contact message at Foodoor!

### Name : {{ $name }}

### Phone : <a href="tel:{{$phone}}">{{ $phone }}</a>

### Email : <a href="mailto:{{$email}}">{{ $email }}</a>

### Message : {{ $message }}

@component('mail::button', ['url' => 'https://foodoor.in'])
Visit Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
