@component('mail::message')
# مرحبا بك عزيزى المشترك
{!! $message !!}

@component('mail::button', ['url' => ''])
لمزيد من التفاصيل
@endcomponent

شكرا,<br>
{{ config('app.name') }}
@endcomponent
