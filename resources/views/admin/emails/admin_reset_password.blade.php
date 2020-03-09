@component('mail::message')
# Introduction
welcome {{$data['data']->name}}<br>
The body of your message.

@component('mail::button', ['url' => aurl('reset/password/'.$data['token'])])
{{trans('admin.click_here_to_reset_password')}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
