@component('mail::message')
# Congratulation, Registration Success!

Hi {{$checkout->User->name}}
<br>
Thank you for register on <b>{{$checkout->Camp->title}}</b>. Please see payment instruction by click the button bellow.
@component('mail::button', ['url' => route('user.dashboard') ])
Click here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
