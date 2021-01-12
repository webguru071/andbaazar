@component('mail::message')
# Hello, {{ $mailData['user_name'] }}

Please click the button below to verify your email address.
This link is valid for 48 hours.

@component('mail::button', ['url' => $mailData['verificationURL']])
Verify Email Address
@endcomponent

If you did not create an account, no further action is required.

Regards,<br>
{{ ucfirst(config('app.name')) }}
@endcomponent
