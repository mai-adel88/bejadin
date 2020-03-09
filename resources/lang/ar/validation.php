<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute يجب قبوله',
    'active_url' => ':attribute  .ليس صالحا  URL عنوان',
    'after' => ':attribute يجب أن يكون تاريخًا بعد :date',
    'after_or_equal' => ':attribute يجب أن يكون التاريخ بعد أو يساوي :date',
    'alpha' => ':attribute قد تحتوي على أحرف فقط',
    'alpha_dash' => ':attribute قد تحتوي فقط على أحرف وأرقام وشرطات وشرطات سفلية',
    'alpha_num' => ':attribute قد يحتوي فقط على أحرف وأرقام',
    'array' => ':attribute يجب أن تكون مصفوفة',
    'before' => ':attribute يجب أن يكون تاريخًا قبل :date',
    'before_or_equal' => ':attribute يجب أن يكون تاريخًا قبل أو يساوي: date',
    'between' => [
        'numeric' => ':attribute يجب ان يكون بين :min و :max',
        'file' => ':attribute يجب ان يكون بين :min و :max كيلو بايت',
        'string' => ':attribute يجب ان يكون بين :min و :max حروف',
        'array' => ':attribute يجب ان يكون بين :min و :max عنصر',
    ],
    'boolean' => ':attribute يجب أن يكون الحقل صحيحًا أو خطأ',
    'confirmed' => ':attribute التأكيد غير متطابق',
    'date' => ':attribute هذا ليس تاريخ صحيح',
    'date_equals' => ':attribute يجب أن يكون تاريخًا مساويا :date',
    'date_format' => ':attribute لا يتطابق مع التنسيق :format',
    'different' => ':attribute و :other must be different.',
    'digits' => ':attribute يجب ان :digits أرقام',
    'digits_between' => ':attribute يجب ان يكون بين :min و :max أرقام',
    'dimensions' => ':attribute يحتوي على أبعاد صور غير صالحة',
    'distinct' => ':attribute يحتوي الحقل على قيمة مكررة',
    'email' => ':attribute يجب أن يكون عنوان بريد إلكتروني صالح',
    'exists' => 'اختر :attribute غير صالح',
    'file' => ':attribute يجب أن يكون الملف',
    'filled' => ':attribute يجب أن يكون الحقل قيمة',
    'gt' => [
        'numeric' => ':attribute يجب أن يكون أكبر من :value',
        'file' => ':attribute يجب أن يكون أكبر من :value كيلو بايت',
        'string' => ':attribute يجب أن يكون أكبر من :value حروف',
        'array' => ':attribute يجب أن يكون أكثر من :value عنصر',
    ],
    'gte' => [
        'numeric' => ':attribute يجب أن يكون أكبر من أو يساوي :value.',
        'file' => ':attribute يجب أن يكون أكبر من أو يساوي :value كيلو بايت',
        'string' => ':attribute يجب أن يكون أكبر من أو يساوي :value حروف',
        'array' => ':attribute يجب ان :value عنصر او اكتر',
    ],
    'image' => ':attribute يجب أن تكون صورة',
    'in' => 'اختر :attribute غير صالح',
    'in_array' => ':attribute الحقل غير موجود في :other',
    'integer' => ':attribute يجب أن يكون صحيحا',
    'ip' => ':attribute يجب أن يكون عنوان IP صالحا',
    'ipv4' => ':attribute يجب أن يكون عنوان IPv4 صالحا',
    'ipv6' => ':attribute يجب أن يكون عنوان IPv6 صالحا',
    'json' => ':attribute يجب أن يكون عبارة عن سلسلة JSON صالحة',
    'lt' => [
        'numeric' => ':attribute يجب أن يكون أقل من :value',
        'file' => ':attribute يجب أن يكون أقل من :value كيلو بايت',
        'string' => ':attribute يجب أن يكون أقل من :value حروف',
        'array' => ':attribute يجب أن يكون أقل من :value عنصر',
    ],
    'lte' => [
        'numeric' => ':attribute يجب أن يكون أقل من أو يساوي :value',
        'file' => ':attribute يجب أن يكون أقل من أو يساوي :value كيلو بايت',
        'string' => ':attribute يجب أن يكون أقل من أو يساوي :value حروف',
        'array' => ':attribute يجب أن يكون أقل من أو يساوي :value عنصر',
    ],
    'max' => [
        'numeric' => ':attribute قد لا يكون أكبر من :max',
        'file' => ':attribute قد لا يكون أكبر من :max كيلو بايت',
        'string' => ':attribute قد لا يكون أكبر من :max حروف',
        'array' => ':attribute قد لا يكون أكبر من :max عنصر',
    ],
    'mimes' => ':attribute يجب أن يكون ملف من نوع: :values',
    'mimetypes' => ':attribute يجب أن يكون ملف من نوع: :values',
    'min' => [
        'numeric' => ':attribute لا بد أن يكون على الأقل :min',
        'file' => ':attribute لا بد أن يكون على الأقل :min كيلو بايت',
        'string' => ':attribute لا بد أن يكون على الأقل :min حروف',
        'array' => ':attribute لا بد أن يكون على الأقل :min عنصر',
    ],
    'not_in' => 'selected :attribute غير صالح',
    'not_regex' => ':attribute التنسيق غير صالح',
    'numeric' => ':attribute يجب أن يكون رقما',
    'present' => ':attribute يجب أن يكون الحقل موجودا',
    'regex' => ':attribute التنسيق غير صالح',
    'required' => ':attribute مطلوبه',
    'required_if' => ':attribute الحقل مطلوب عندما :other يكون :value',
    'required_unless' => ':attribute الحقل مطلوب عندما :other يكون في :values',
    'required_with' => ':attribute الحقل مطلوب عندما :values يكون حاضر',
    'required_with_all' => ':attribute الحقل مطلوب عندما :values يكونو حاضرين',
    'required_without' => ':attribute الحقل مطلوب عندما :values غير موجود',
    'required_without_all' => ':attribute حقل مطلوب عند لا شيء من :values يكونو حاضرين',
    'same' => ':attribute و :other يجب أن تتطابق',
    'size' => [
        'numeric' => ':attribute يجب ان يكون :size',
        'file' => ':attribute يجب ان يكون :size كيلو بايت',
        'string' => ':attribute يجب ان يكون :size حروف',
        'array' => ':attribute يجب أن تحتوي على :size عنصر',
    ],
    'starts_with' => ':attribute يجب أن يبدأ بأحد ما يلي: :values',
    'string' => ':attribute يجب أن تكون سلسلة',
    'timezone' => ':attribute يجب أن تكون منطقة صالحة',
    'unique' => ':attribute لقد اتخذت بالفعل',
    'uploaded' => ':attribute فشل في التحميل',
    'url' => ':attribute التنسيق غير صالح',
    'uuid' => ':attribute يجب أن يكون UUID صالحا',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'رسالة مخصصة',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
