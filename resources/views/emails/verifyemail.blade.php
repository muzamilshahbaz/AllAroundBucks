@component('mail::message')
# Verify Your Email

Copy and Paste the following 5-digit code and verify your account.

{{-- @component('mail::button', ['url' => ''])
Verify Now
@endcomponent --}}

@component('mail::message')

{{ $code['vCode'] }}

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
