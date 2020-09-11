@component('mail::message')
# Welcome Mail from Message_system

You are receiving this message because you registered on {{ config('app.name') }}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks for joining us,<br>
{{ config('app.name') }}
@endcomponent
