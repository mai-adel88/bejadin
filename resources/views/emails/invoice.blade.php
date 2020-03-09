@component('mail::message')
# مرحبا بك عزيزى المشترك

تم قبول طلب الاشتراك المقدم بنجاح وتم سداد المبلغ المستحق ولكم جزيل الشكر

<strong>اسم المشترك:</strong>
{{$name_en}}
<br>
<strong>رقم الفاتورة:</strong>
{{$invoice}}
@component('mail::button', ['url' => url('/profile')])
لمزيد من التفاصيل
@endcomponent

شكرا,<br>
{{ session_lang(setting()->sitename_en,setting()->sitename_) }}
@endcomponent
