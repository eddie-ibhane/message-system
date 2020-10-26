@component('mail::message')
#Hello {{ $user->name }},
# Welcome Mail from Message_system

You are receiving this message because you registered on {{ config('app.name') }} with {{ $user->email }}
Thank you for using our app.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks for joining us,<br>
{{ config('app.name') }}
@endcomponent
