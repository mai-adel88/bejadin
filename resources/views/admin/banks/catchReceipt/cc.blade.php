
@if($cc != null)
<script>
    $(function () {
        'use strict';
        $('.e3').select2({
            placeholder: "{{trans('admin.select')}}",
            dir: '{{direction()}}'
        });
    });
</script>
<script>
    $(function () {
        'use strict';
        $('.tree').parent('.col-md-12').removeClass().addClass('col-md-6').find('.select2').width('100%');
        $('.column-account-cc').addClass('col-md-6').find('.select2').width('100%');
    });
</script>

{{ Form::label('cc_id', trans('admin.cc'), ['class' => 'control-label']) }}
<select name="cc_id" class="form-control e3 cc" placeholder="{{trans('admin.select')}}">
    <option></option>
    @foreach ($products as $product)
        <option value="{{$product->id}}">{{session_lang($product->name_en,$product->name_ar)}}</option>
    @endforeach
</select>

    @else

    <script>
        $(function () {
            'use strict';
            $('.tree').parent('.col-md-6').removeClass().addClass('col-md-12').find('.select2').width('100%');
        });
    </script>
@endif