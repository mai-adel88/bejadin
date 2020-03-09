@component('mail::message')


    المشترك: {{session_lang($name_en,$name_ar)}} سوف ينتهى الاشتراك بعد يومين




شكرا,<br>
{{ config('app.name') }}
@endcomponent
