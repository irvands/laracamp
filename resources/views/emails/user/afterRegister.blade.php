@component('mail::message')
# welcome
 Hi {{$user->name}}!
<br>
Welcome to Laracamp, your account has been created successfully. Now you can choose your match camp!



@component('mail::button', ['url' => route('user.login.google') ])
Login Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
