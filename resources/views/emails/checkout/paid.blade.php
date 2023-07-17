@component('mail::message')
# Congratulation!

Hi {{$checkout->User->name}}!
<br>Your camp {{$checkout->Camp->title}} has been confirmed, enjoy your benefits!

@component('mail::button', ['url' => route('user.dashboard')])
My Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
