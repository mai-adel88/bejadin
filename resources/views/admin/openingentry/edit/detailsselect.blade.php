
<script>

    $(function () {
        'use strict'
        $('.creditor').val($('.totel_credit').val());
        $('.debtor').val($('.totel_debtor').val());
    });

</script>
<script>

    $(function () {
        'use strict'
        $('.e2').select2({
            placeholder: "{{trans('admin.select')}}",
            dir: '{{direction()}}'
        });
    });



</script>
<div class="form-group">
    {{ Form::label('tree', session_lang($operation->name_en,$operation->name_ar), ['class' => 'control-label']) }}
    {{ Form::select('tree',$tree,null, array_merge(['class' => 'form-control e2 tree','placeholder'=> trans('admin.select') ])) }}
</div>